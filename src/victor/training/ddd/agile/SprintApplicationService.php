<?php /** @noinspection PhpUnused */

namespace victor\training\ddd\agile;


use Exception;

interface SprintRepo
{

    public function save(Sprint $sprint): Sprint;

    public function findOneById(int $id): Sprint;
}

class SprintDto
{
    public int $productId;
    public \DateTimeImmutable $plannedEnd;
}


class SprintMetrics
{
    public int $consumedHours;
    public int $doneFP;
    public float $fpVelocity;
    public int $hoursConsumedForNotDone;
    public int $calendarDays;
    public int $delayDays;
}


class AddBacklogItemRequest
{
    public int $productBacklogId;
    public int $fpEstimation;
}

class LogHoursRequest
{
    public int $sprintBacklogItemId;
    public int $hours;
}


class SprintApplicationService
{
    private SprintRepo $sprintRepo;
    private ProductRepo $productRepo;
    private EmailService $emailService;
    private SprintMetricsService $metricsService;

    public function __construct(SprintRepo $sprintRepo, ProductRepo $productRepo, EmailService $emailService, SprintMetricsService $metricsService)
    {
        $this->sprintRepo = $sprintRepo;
        $this->productRepo = $productRepo;
        $this->emailService = $emailService;
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
            $this->emailService->sendNotDoneItemsDebrief(
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

