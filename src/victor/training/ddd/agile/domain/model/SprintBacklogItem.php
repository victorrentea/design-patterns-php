<?php

namespace victor\training\ddd\agile;

use Exception;

// uneori cand lucrezi masiv cu ID-uri din exterior,
// decizi sa creezi un Value Object cu un singur camp ID
// "ID Types"
// class ProductBacklogItemId {
//     private int $id;
// }

class SprintBacklogItem
{
    const STATUS_CREATED = 'CREATED';
    const STATUS_STARTED = 'STARTED';
    const STATUS_DONE = 'DONE';

    private int $id;
    // private ProductBacklogItemId $backlogItemId;
    private int $productBacklogItemId;
    private string $status = self::STATUS_CREATED;

    private int $fpEstimation;
    private int $hoursConsumed = 0;

    // private int $version; // for optimistic locking
    public function __construct(int $productBacklogItemId, int $fpEstimation)
    {
        $this->productBacklogItemId = $productBacklogItemId;
        $this->fpEstimation = $fpEstimation;
    }

    public function getProductBacklogItemId(): int
    {
        return $this->productBacklogItemId;
    }

    public function addHours(int $hours)
    {
        if ($this->status !== SprintBacklogItem::STATUS_STARTED) {
            throw new Exception("Item not started");
        }
        $this->hoursConsumed += $hours;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): SprintBacklogItem
    {
        $this->id = $id;
        return $this;
    }



    public function getStatus(): string
    {
        return $this->status;
    }

    public function getFpEstimation(): int
    {
        return $this->fpEstimation;
    }


    public function getHoursConsumed(): int
    {
        return $this->hoursConsumed;
    }


    public function start(): void
    {
        if ($this->getStatus() != SprintBacklogItem::STATUS_CREATED) {
            throw new Exception("Item already started");
        }
        $this->setStatus(SprintBacklogItem::STATUS_STARTED);
    }

    public function complete(): void
    {
        if ($this->getStatus() != SprintBacklogItem::STATUS_STARTED) {
            throw new Exception("Cannot complete an Item before starting it");
        }
        $this->setStatus(SprintBacklogItem::STATUS_DONE);
    }
}
