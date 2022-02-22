<?php

namespace victor\training\ddd\agile;

class Release
{
    private int $id;
    // private int $productId;
    // private string $productCode; // date care nu se modifica
    // private Product $product;

    private string $version;  // eg 1.0, 2.0 ...
    private \DateTime $date;
    private Sprint $sprint; // sprintul care a fost releaseuit. TODO la fel rupt linkul
    private string $releaseNotes;

    public function getId(): int
    {
        return $this->id;
    }

    public function getReleaseNotes(): string
    {
        return $this->releaseNotes;
    }

    public function setReleaseNotes(string $releaseNotes): Release
    {
        $this->releaseNotes = $releaseNotes;
        return $this;
    }


    public function setId(int $id): Release
    {
        $this->id = $id;
        return $this;
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


}