<?php

namespace victor\training\ddd\agile;


use DateTime;
use DateTimeImmutable;
use Exception;


// @Entity
class Sprint
{
    const STATUS_CREATED = 'CREATED';
    const STATUS_STARTED = 'STARTED';
    const STATUS_FINISHED = 'FINISHED';

    private int $id;
    private int $iteration;
    private Product $product; // ILLEGAL reference to another Aggregate
    private DateTimeImmutable $start;
    private DateTimeImmutable $plannedEnd;
    private DateTimeImmutable $end;

    private string $status = self::STATUS_CREATED;

    /** @var BacklogItem[] */
    private array $items = [];

    public function __construct(Product $product, DateTimeImmutable $plannedEnd)
    {
        $this->product = $product;
        $this->iteration = $product->incrementAndGetIteration();
        $this->plannedEnd = $plannedEnd;
    }


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


    public function getProduct(): Product
    {
        return $this->product;
    }


    public function getStart(): DateTimeImmutable
    {
        return $this->start;
    }


    public function getPlannedEnd(): DateTimeImmutable
    {
        return $this->plannedEnd;
    }


    public function getEnd(): DateTimeImmutable
    {
        return $this->end;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(BacklogItem $backlogItem)
    {
        $this->items [] = $backlogItem;
    }

    public function start(): void
    {
        if ($this->status !== Sprint::STATUS_CREATED) {
            throw new Exception("Illegal State");
        }
        $this->status=Sprint::STATUS_STARTED;
        $this->start = new DateTimeImmutable();

        $this->product->setCurrentIteration(-1);

    }

    public function end(): void
    {
        if ($this->status !== Sprint::STATUS_STARTED) {
            throw new Exception("Illegal State");
        }
        $this->end = new DateTimeImmutable();
        $this->status = Sprint::STATUS_FINISHED;
    }
}