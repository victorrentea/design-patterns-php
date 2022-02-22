<?php

namespace victor\training\ddd\agile;


use DateTimeImmutable;
use Exception;
use victor\training\ddd\agile\domain\event\DomainEvents;


// @Entity
class Sprint
{
    const STATUS_CREATED = 'CREATED';
    const STATUS_STARTED = 'STARTED';
    const STATUS_FINISHED = 'FINISHED';

    private int $id;
    private int $iteration;

    private int $productId; // FK din DB

    // transient "volatil" = CODE SMELL : temporary field.
    // private ?ProductVO $productVO;

    private DateTimeImmutable $start;
    private DateTimeImmutable $plannedEnd;
    private DateTimeImmutable $end;

    private string $status = self::STATUS_CREATED;

    /** @var SprintBacklogItem[] */
    private array $items = [];

    public function __construct(int $productId, DateTimeImmutable $plannedEnd, int $iteration)
    {
        $this->productId = $productId;
        $this->iteration = $iteration;
        $this->plannedEnd = $plannedEnd;
    }

    public function getProductId(): int
    {
        return $this->productId;
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

    public function addItem(SprintBacklogItem $backlogItem)
    {
        if ($this->status != Sprint::STATUS_CREATED) {
            throw new Exception("Can only add items to Sprint before it starts");
        }
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

    private function findItemById(int $backlogId): SprintBacklogItem
    {
        $backlogItem = array_filter($this->items,
            fn(SprintBacklogItem $item) => $item->getId() === $backlogId)[0];
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
            if ($backlogItem->getStatus() !== SprintBacklogItem::STATUS_DONE) {
                return false;
            }
        }
        return true;
    }
}