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
    public int $backlogId;
    public int $fpEstimation;
}

class LogHoursRequest
{
    public int $backlogId;
    public int $hours;
}


class SprintService
{
    private SprintRepo $sprintRepo;
    private ProductRepo $productRepo;
    private BacklogItemRepo $backlogItemRepo;
    private EmailService $emailService;

    public function __construct(SprintRepo $sprintRepo, ProductRepo $productRepo, BacklogItemRepo $backlogItemRepo, EmailService $emailService)
    {
        $this->sprintRepo = $sprintRepo;
        $this->productRepo = $productRepo;
        $this->backlogItemRepo = $backlogItemRepo;
        $this->emailService = $emailService;
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
            if ($backlogItem->getStatus() !== BacklogItem::STATUS_DONE) {
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
        $sprint = $this->sprintRepo->findOneById($id);
        if ($sprint->getStatus() !== Sprint::STATUS_FINISHED) {
            throw new Exception("Illegal state");
        }
        $dto = new SprintMetrics();
        $dto->consumedHours = 0;
        foreach ($sprint->getItems() as $backlogItem) {
            $dto->consumedHours += $backlogItem->getHoursConsumed();
        }

        $dto->calendarDays = $sprint->getEnd()->diff($sprint->getStart())->days;
        $dto->doneFP = 0;
        foreach ($sprint->getItems() as $item) {
            if ($item->getStatus() === BacklogItem::STATUS_DONE) {
                $dto->doneFP += $item->getFpEstimation();
            }
        }
        $dto->fpVelocity = 1.0 * $dto->doneFP / $dto->consumedHours;

        $dto->hoursConsumedForNotDone = 0;
        foreach ($sprint->getItems() as $item) {
            if ($item->getStatus() !== BacklogItem::STATUS_DONE) {
                $dto->hoursConsumedForNotDone += $item->getHoursConsumed();
            }
        }

        if ($sprint->getEnd()->getTimestamp() > $sprint->getPlannedEnd()->getTimestamp()) {
            $dto->delayDays = $sprint->getEnd()->diff($sprint->getPlannedEnd())->days;
        }
        return $dto;
    }


    public function addItem(int $sprintId, AddBacklogItemRequest $request): void
    {
        $backlogItem = $this->backlogItemRepo->findOneById($request->backlogId);
        $sprint = $this->sprintRepo->findOneById($sprintId);
        if ($sprint->getStatus() != Sprint::STATUS_CREATED) {
            throw new Exception("Can only add items to Sprint before it starts");
        }
        $sprint->addItem($backlogItem);
        $backlogItem->assignToSprint($sprint, $request->fpEstimation);

    }

    // POST /sprint/{$sprintId}/item/${backlogId}/start
    public function startItem(int $sprintId, int $backlogId): void
    {
        $sprint = $this->sprintRepo->findOneById($sprintId);
        $sprint->startItem($backlogId);
    }

    public function completeItem(int $sprintId, int $backlogId): void
    {
        $sprint = $this->sprintRepo->findOneById($sprintId);
        $sprint->completeItem($backlogId);
        $this->sprintRepo->save($sprint); // IDEE_CREATA: automatic domain events publishing
    }

    public function logHours(int $sprintId, LogHoursRequest $request): void
    {
        // MAINE dispare BacklogItemRepo!!!!!!!
        // ori de cate ori vrei item, aduci Sprintu parinte care vine cu ai lui 10-20 de copii.
        // $backlogItem = $this->backlogItemRepo->findOneById($request->backlogId);

        $sprint = $this->sprintRepo->findOneById($sprintId);

        $sprint->addHoursToItem($request->backlogId, $request->hours);
    }

}

