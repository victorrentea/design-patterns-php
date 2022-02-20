<?php

namespace victor\training\ddd\agile;


use DateTime;
use Exception;

interface SprintRepo
{

    public function save(Sprint $sprint): Sprint;

    public function findOneById(int $id): Sprint;
}

class SprintDto
{
    public int $productId;
    public DateTime $plannedEnd;
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
    private MailingListService $mailingListService;

    public function __construct(SprintRepo $sprintRepo, ProductRepo $productRepo, BacklogItemRepo $backlogItemRepo, EmailService $emailService, MailingListService $mailingListService)
    {
        $this->sprintRepo = $sprintRepo;
        $this->productRepo = $productRepo;
        $this->backlogItemRepo = $backlogItemRepo;
        $this->emailService = $emailService;
        $this->mailingListService = $mailingListService;
    }

    public function createSprint(SprintDto $dto): int
    {
        $product = $this->productRepo->findOneById($dto->productId);
        $sprint = (new Sprint())
            ->setIteration($product->incrementAndGetIteration())
            ->setProduct($product)
            ->setPlannedEnd($dto->plannedEnd);
        return $this->sprintRepo->save($sprint)->getId();
    }

    public function getSprint(int $id): Sprint
    {
        return $this->sprintRepo->findOneById($id);
    }

    public function startSprint(int $id): void
    {
        $sprint = $this->sprintRepo->findOneById($id);
        if ($sprint->getStatus() !== Sprint::STATUS_CREATED) {
            throw new Exception("Illegal State");
        }
        $sprint->setStart(new DateTime());
        $sprint->setStatus(Sprint::STATUS_STARTED);
    }

    public function endSprint(int $id)
    {
        $sprint = $this->sprintRepo->findOneById($id);
        if ($sprint->getStatus() !== Sprint::STATUS_STARTED) {
            throw new Exception("Illegal State");
        }
        $sprint->setEnd(new DateTime());
        $sprint->setStatus(Sprint::STATUS_FINISHED);

        $notDoneItems = [];
        foreach ($sprint->getItems() as $backlogItem) {
            if ($backlogItem->getStatus() !== BacklogItem::STATUS_DONE) {
                $notDoneItems [] = $backlogItem;
            }
        }

        if (sizeof($notDoneItems) >= 1) {
            $this->emailService->sendNotDoneItemsDebrief($sprint->getProduct()->getOwnerEmail(), $notDoneItems);
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
        $backlogItem->setSprint($sprint);
        $sprint->addItem($backlogItem);
        $backlogItem->setFpEstimation($request->fpEstimation);
    }


    public function startItem(int $id, int $backlogId): void
    {
        $backlogItem = $this->backlogItemRepo->findOneById($backlogId);
        $this->checkSprintMatchesAndStarted($id, $backlogItem);
        if ($backlogItem->getStatus() != BacklogItem::STATUS_CREATED) {
            throw new Exception("Item already started");
        }
        $backlogItem->setStatus(BacklogItem::STATUS_STARTED);
    }

    private function checkSprintMatchesAndStarted(int $id, BacklogItem $backlogItem): void
    {
        if ($backlogItem->getSprint()->getId() !== $id) {
            throw new Exception("item not in sprint");
        }

        $sprint = $this->sprintRepo->findOneById($id);
        if ($sprint->getStatus() != Sprint::STATUS_STARTED) {
            throw new Exception("Sprint not started");
        }
    }

    public function completeItem(int $id, int $backlogId): void
    {
        $backlogItem = $this->backlogItemRepo->findOneById($backlogId);
        $this->checkSprintMatchesAndStarted($id, $backlogItem);
        if ($backlogItem->getStatus() != BacklogItem::STATUS_STARTED) {
            throw new Exception("Cannot complete an Item before starting it");
        }
        $backlogItem->setStatus(BacklogItem::STATUS_DONE);
        $sprint = $this->sprintRepo->findOneById($id);

        $allDone = true;
        foreach ($sprint->getItems() as $backlogItem) {
            if ($backlogItem->getStatus() !== BacklogItem::STATUS_DONE) {
                $allDone = false;
                break;
            }
        }
        if (!$allDone) {
            echo "Sending CONGRATS email to team of product " . $sprint->getProduct()->getCode() . ": They finished the items earlier. They have time to refactor! (OMG!)";
            $emails = $this->mailingListService->retrieveEmails($sprint->getProduct()->getTeamMailingList());
            $this->emailService->sendCongratsEmail($emails);
        }
    }

    public function logHours(int $id, LogHoursRequest $request): void
    {
        $backlogItem = $this->backlogItemRepo->findOneById($request->backlogId);
        $this->checkSprintMatchesAndStarted($id, $backlogItem);
        if ($backlogItem->getStatus() !== BacklogItem::STATUS_STARTED) {
            throw new Exception("Item not started");
        }
        $backlogItem->addHours($request->hours);
    }

}