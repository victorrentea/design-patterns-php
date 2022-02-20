<?php

namespace victor\training\ddd\agile;




class BacklogItem
{
    const STATUS_CREATED = 'CREATED';
    const STATUS_STARTED = 'STARTED';
    const STATUS_DONE = 'DONE';

    private int $id;
    private Product $product;
    private string $title;
    private string $description;
    private string $status = self::STATUS_CREATED;


    private Sprint $sprint; // ⚠ not NULL when assigned to a sprint
    private int $fpEstimation; // ⚠ not NULL when assigned to a sprint
    private int $hoursConsumed; // ⚠ not NULL when assigned to a sprint

    private int $version; // for optimistic locking

    public function addHours(int $hours)
    {
        $this->hoursConsumed += $hours;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): BacklogItem
    {
        $this->id = $id;
        return $this;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): BacklogItem
    {
        $this->product = $product;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): BacklogItem
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): BacklogItem
    {
        $this->description = $description;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): BacklogItem
    {
        $this->status = $status;
        return $this;
    }

    public function getSprint(): Sprint
    {
        return $this->sprint;
    }

    public function setSprint(Sprint $sprint): BacklogItem
    {
        $this->sprint = $sprint;
        return $this;
    }

    public function getFpEstimation(): int
    {
        return $this->fpEstimation;
    }

    public function setFpEstimation(int $fpEstimation): BacklogItem
    {
        $this->fpEstimation = $fpEstimation;
        return $this;
    }

    public function getHoursConsumed(): int
    {
        return $this->hoursConsumed;
    }

    public function setHoursConsumed(int $hoursConsumed): BacklogItem
    {
        $this->hoursConsumed = $hoursConsumed;
        return $this;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): BacklogItem
    {
        $this->version = $version;
        return $this;
    }
}
