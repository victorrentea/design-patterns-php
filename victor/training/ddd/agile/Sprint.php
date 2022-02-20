<?php

namespace victor\training\ddd\agile;


use DateTime;


class Sprint
{
    const STATUS_CREATED = 'CREATED';
    const STATUS_STARTED = 'STARTED';
    const STATUS_FINISHED = 'FINISHED';

    private int $id;
    private int $iteration;
    private Product $product;
    private DateTime $start;
    private DateTime $plannedEnd;
    private DateTime $end;

    private string $status = self::STATUS_CREATED;

   /** @var BacklogItem[] */
   private array $items = [];


    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): Sprint
    {
        $this->id = $id;
        return $this;
    }
    public function getIteration(): int
    {
        return $this->iteration;
    }
    public function setIteration(int $iteration): Sprint
    {
        $this->iteration = $iteration;
        return $this;
    }
    public function getProduct(): Product
    {
        return $this->product;
    }
    public function setProduct(Product $product): Sprint
    {
        $this->product = $product;
        return $this;
    }
    public function getStart(): DateTime
    {
        return $this->start;
    }
    public function setStart(DateTime $start): Sprint
    {
        $this->start = $start;
        return $this;
    }
    public function getPlannedEnd(): DateTime
    {
        return $this->plannedEnd;
    }
    public function setPlannedEnd(DateTime $plannedEnd): Sprint
    {
        $this->plannedEnd = $plannedEnd;
        return $this;
    }
    public function getEnd(): DateTime
    {
        return $this->end;
    }
    public function setEnd(DateTime $end): Sprint
    {
        $this->end = $end;
        return $this;
    }
    public function getStatus(): string
    {
        return $this->status;
    }
    public function setStatus(string $status): Sprint
    {
        $this->status = $status;
        return $this;
    }
    public function getItems(): array
    {
        return $this->items;
    }
    public function setItems(array $items): Sprint
    {
        $this->items = $items;
        return $this;
    }

    public function addItem(BacklogItem $backlogItem)
    {
        $this->items [] = $backlogItem;
    }
}