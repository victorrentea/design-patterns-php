<?php

namespace victor\training\ddd\agile;

class Release
{
    private int $id;
    private Product $product;

    private string $version;  // eg 1.0, 2.0 ...
    private \DateTime $date;
    private Sprint $sprint;

    /** @var BacklogItem[] */
    private array $releasedItems; // only used for release notes

    public function getReleaseNotes(): string
    {
        $releaseNotes = "";
        foreach ($this->releasedItems as $backlogItem) {
            $this->releasedItems .= $backlogItem->getTitle() . "\n";
        }
        return $releaseNotes;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Release
    {
        $this->id = $id;
        return $this;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): Release
    {
        $this->product = $product;
        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): Release
    {
        $this->version = $version;
        return $this;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): Release
    {
        $this->date = $date;
        return $this;
    }

    public function getSprint(): Sprint
    {
        return $this->sprint;
    }

    public function setSprint(Sprint $sprint): Release
    {
        $this->sprint = $sprint;
        return $this;
    }

    public function getReleasedItems(): array
    {
        return $this->releasedItems;
    }

    public function setReleasedItems(array $releasedItems): Release
    {
        $this->releasedItems = $releasedItems;
        return $this;
    }


}