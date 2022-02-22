<?php

namespace victor\training\ddd\agile;

// @Entity
class Product
{
    private int $id;
    private int $currentIteration = 0;
    private int $currentVersion = 0;
    private string $code;
    private string $name;

    // @Embedded
    private PersonContact $owner;

    private string $teamMailingList;

    /** @var ProductBacklogItem[] */
    private array $backlogItems = [];
    /** @var Sprint[] */
    private array $sprints = [];
    /** @var Release[] */
    private array $releases = [];

    public function __construct(PersonContact $owner)
    {
        $this->owner = $owner;
    }

    public function getOwner(): PersonContact
    {
        return $this->owner;
    }

    public function incrementAndGetIteration(): int
    {
        $this->currentIteration++;
        return $this->currentIteration;
    }


    public function incrementAndGetVersion(): int
    {
        $this->currentVersion++;
        return $this->currentVersion;
    }


    public function addBacklogItem(ProductBacklogItem $backlogItem)
    {
        $this->backlogItems[] = $backlogItem;
    }

    function addSprint(Sprint $sprint)
    {
        $this->sprints[] = $sprint;
    }

    function addRelease(Release $release)
    {
        $this->releases[] = $release;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Product
    {
        $this->id = $id;
        return $this;
    }

    public function getCurrentIteration(): int
    {
        return $this->currentIteration;
    }

    public function setCurrentIteration(int $currentIteration): Product
    {
        $this->currentIteration = $currentIteration;
        return $this;
    }

    public function getCurrentVersion(): int
    {
        return $this->currentVersion;
    }

    public function setCurrentVersion(int $currentVersion): Product
    {
        $this->currentVersion = $currentVersion;
        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): Product
    {
        $this->code = $code;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    public function getTeamMailingList(): string
    {
        return $this->teamMailingList;
    }

    public function setTeamMailingList(string $teamMailingList): Product
    {
        $this->teamMailingList = $teamMailingList;
        return $this;
    }

    public function getBacklogItems(): array
    {
        return $this->backlogItems;
    }

    public function setBacklogItems(array $backlogItems): Product
    {
        $this->backlogItems = $backlogItems;
        return $this;
    }

    public function getSprints(): array
    {
        return $this->sprints;
    }

    public function setSprints(array $sprints): Product
    {
        $this->sprints = $sprints;
        return $this;
    }

    public function getReleases(): array
    {
        return $this->releases;
    }

    public function setReleases(array $releases): Product
    {
        $this->releases = $releases;
        return $this;
    }


}
