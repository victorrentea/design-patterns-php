<?php

namespace victor\training\ddd\agile;

use Exception;

class SprintBacklogItem
{
    const STATUS_CREATED = 'CREATED';
    const STATUS_STARTED = 'STARTED';
    const STATUS_DONE = 'DONE';

    private int $id;
    private int $productBacklogItemId;
    // private string $title;
    // private string $description;
    private string $status = self::STATUS_CREATED;

    private Sprint $sprint;
    private int $fpEstimation;
    private int $hoursConsumed = 0;

    // private int $version; // for optimistic locking



    public function addHours(int $hours)
    {
        if ($this->status !== ProductBacklogItem::STATUS_STARTED) {
            throw new Exception("Item not started");
        }
        $this->hoursConsumed += $hours;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ProductBacklogItem
    {
        $this->id = $id;
        return $this;
    }


    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): ProductBacklogItem
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): ProductBacklogItem
    {
        $this->description = $description;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): ProductBacklogItem
    {
        $this->status = $status;
        return $this;
    }

    public function getSprint(): Sprint
    {
        return $this->sprint;
    }

    public function getFpEstimation(): int
    {
        return $this->fpEstimation;
    }


    public function getHoursConsumed(): int
    {
        return $this->hoursConsumed;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): ProductBacklogItem
    {
        $this->version = $version;
        return $this;
    }

    public function assignToSprint(Sprint $sprint, int $fpEstimation): void
    {
        $this->sprint = $sprint;
        $this->fpEstimation = $fpEstimation;
    }

    public function start(): void
    {
        if ($this->getStatus() != ProductBacklogItem::STATUS_CREATED) {
            throw new Exception("Item already started");
        }
        $this->setStatus(ProductBacklogItem::STATUS_STARTED);
    }

    public function complete(): void
    {
        if ($this->getStatus() != ProductBacklogItem::STATUS_STARTED) {
            throw new Exception("Cannot complete an Item before starting it");
        }
        $this->setStatus(ProductBacklogItem::STATUS_DONE);
    }
}
