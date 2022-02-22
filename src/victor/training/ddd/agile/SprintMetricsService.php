<?php

namespace victor\training\ddd\agile;

use Exception;

class SprintMetricsService
{
    private SprintRepo $sprintRepo;

    public function __construct(SprintRepo $sprintRepo)
    {
        $this->sprintRepo = $sprintRepo;
    }


    public function generateSprintMetricsService(int $id): SprintMetrics
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
            if ($item->getStatus() === SprintBacklogItem::STATUS_DONE) {
                $dto->doneFP += $item->getFpEstimation();
            }
        }
        $dto->fpVelocity = 1.0 * $dto->doneFP / $dto->consumedHours;

        $dto->hoursConsumedForNotDone = 0;
        foreach ($sprint->getItems() as $item) {
            if ($item->getStatus() !== SprintBacklogItem::STATUS_DONE) {
                $dto->hoursConsumedForNotDone += $item->getHoursConsumed();
            }
        }

        if ($sprint->getEnd()->getTimestamp() > $sprint->getPlannedEnd()->getTimestamp()) {
            $dto->delayDays = $sprint->getEnd()->diff($sprint->getPlannedEnd())->days;
        }
        return $dto;
    }
}