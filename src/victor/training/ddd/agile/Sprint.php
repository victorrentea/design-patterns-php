<?php

namespace victor\training\ddd\agile;


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
        if (!in_array($this->status, [Sprint::STATUS_CREATED/*, Sprint::ALT_STATUS*/])) {
            throw new Exception("Illegal State");
        }
        $this->status = Sprint::STATUS_STARTED;
        $this->start = new DateTimeImmutable();
    }

    public function end(): void
    {
        if ($this->status !== Sprint::STATUS_STARTED) {
            throw new Exception("Illegal State");
        }
        $this->end = new DateTimeImmutable();
        $this->status = Sprint::STATUS_FINISHED;
    }

    public function addHoursToItem(int $backlogId, int $hours)
    {
        if ($this->getStatus() != Sprint::STATUS_STARTED) {
            throw new Exception("Sprint not started");
        }
        $backlogItem = $this->findItemById($backlogId);

        $backlogItem->addHours($hours);
    }

    public function startItem(int $backlogItemId): void
    {
        $backlogItem = $this->findItemById($backlogItemId);
        if ($this->getStatus() != Sprint::STATUS_STARTED) {
            throw new Exception("Sprint not started");
        }
        $backlogItem->start();
    }

    private function findItemById(int $backlogId): BacklogItem
    {
        $backlogItem = array_filter($this->items,
            fn(BacklogItem $item) => $item->getId() === $backlogId)[0];
        return $backlogItem;
    }

    public function completeItem(int $backlogItemId): void
    {
        $backlogItem = $this->findItemById($backlogItemId);
        if ($this->getStatus() != Sprint::STATUS_STARTED) {
            throw new Exception("Sprint not started");
        }
        $backlogItem->complete();

        // Solutia2: (Domain Events) : permite sa pui MAI MULTA LOGICA in agregate
        if ($this->allItemsAreDone()) {
            DomainEvents::publishEvent('sprint.completed.event', $this->id);
            // alternativa
            // $this->domainEvents[] = new SprintCompletedEvent($this->id);
            // in super clasa (AbstractAggregateRoot dintr-un framework)
            // adaugi eventul tau, si ulterior, cand faci $sprintRepo->save($spring); din applicationService,
            // frameworkul (sau Repoul tau) poate inspecta campul domainEvents mostenit si daca sunt elemente
            // sa le faca publish in framework. IDEE_CREATA
        }
    }
    // NICIODATA private MailingListService $mailingListService;// DOAMNEFERESTE de COrder


    public function allItemsAreDone(): bool
    {
        foreach ($this->items as $backlogItem) {
            if ($backlogItem->getStatus() !== BacklogItem::STATUS_DONE) {
                return false;
            }
        }
        return true;
    }
}