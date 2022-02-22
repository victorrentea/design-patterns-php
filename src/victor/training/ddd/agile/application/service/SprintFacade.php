<?php /** @noinspection PhpUnused */

namespace victor\training\ddd\agile\application\service;


use victor\training\ddd\agile\application\dto\AddBacklogItemRequest;
use victor\training\ddd\agile\application\dto\LogHoursRequest;
use victor\training\ddd\agile\application\dto\SprintDto;
use victor\training\ddd\agile\domain\repo\ProductRepo;
use victor\training\ddd\agile\domain\repo\SprintRepo;
use victor\training\ddd\agile\Sprint;
use victor\training\ddd\agile\SprintBacklogItem;
use victor\training\ddd\agile\SprintMetrics;

class SprintFacade
{
    private SprintRepo $sprintRepo;
    private ProductRepo $productRepo;
    private EmailSenderInterface $emailSender;
    private SprintMetricsService $metricsService;

    public function __construct(SprintRepo $sprintRepo, ProductRepo $productRepo, EmailSenderInterface $emailSender, SprintMetricsService $metricsService)
    {
        $this->sprintRepo = $sprintRepo;
        $this->productRepo = $productRepo;
        $this->emailSender = $emailSender;
        $this->metricsService = $metricsService;
    }

    public function createSprint(SprintDto $dto): int
    {
        $product = $this->productRepo->findOneById($dto->productId);
        $sprint = new Sprint($product->getId(), $dto->plannedEnd, $product->incrementAndGetIteration());
        return $this->sprintRepo->save($sprint)->getId();
    }

    public function getSprint(int $id): Sprint // TODO to Dto
    {
        return $this->sprintRepo->findOneById($id);
    }

    public function startSprint(int $sprintId): void
    {
        $sprint = $this->sprintRepo->findOneById($sprintId);
        $sprint->start();
        $this->sprintRepo->save($sprint); // required only if doctrine doesn't auto-flush dirty entities
    }

    public function endSprint(int $id)
    {
        $sprint = $this->sprintRepo->findOneById($id);
        $sprint->end();

        $notDoneItems = [];
        foreach ($sprint->getItems() as $backlogItem) {
            if ($backlogItem->getStatus() !== SprintBacklogItem::STATUS_DONE) {
                $notDoneItems [] = $backlogItem;
            }
        }
        if (sizeof($notDoneItems) >= 1) {
            $product = $this->productRepo->findOneById($sprint->getProductId());
            $this->emailSender->sendNotDoneItemsDebrief(
                $product->getOwner()->getEmail(), $notDoneItems);
        }
    }

    public function getSprintMetrics(int $id): SprintMetrics
    {
        return $this->metricsService->generateSprintMetricsService($id);
    }

    public function addItem(int $sprintId, AddBacklogItemRequest $request): void
    {
        $sprint = $this->sprintRepo->findOneById($sprintId);
        $sprintItem = new SprintBacklogItem($request->productBacklogId, $request->fpEstimation);
        $sprint->addItem($sprintItem);
    }

    // POST /sprint/{$sprintId}/item/${backlogId}/start
    public function startItem(int $sprintId, int $sprintBacklogItemId): void
    {
        $sprint = $this->sprintRepo->findOneById($sprintId);
        $sprint->startItem($sprintBacklogItemId);
    }

    public function completeItem(int $sprintId, int $sprintBacklogItemId): void
    {
        $sprint = $this->sprintRepo->findOneById($sprintId);
        $sprint->completeItem($sprintBacklogItemId);
        $this->sprintRepo->save($sprint); // IDEE_CREATA: automatic domain events publishing
    }

    public function logHours(int $sprintId, LogHoursRequest $request): void
    {
        // MAINE dispare BacklogItemRepo!!!!!!!
        // ori de cate ori vrei item, aduci Sprintu parinte care vine cu ai lui 10-20 de copii.
        // $backlogItem = $this->backlogItemRepo->findOneById($request->backlogId);

        $sprint = $this->sprintRepo->findOneById($sprintId);

        $sprint->addHoursToItem($request->sprintBacklogItemId, $request->hours);
    }



}

