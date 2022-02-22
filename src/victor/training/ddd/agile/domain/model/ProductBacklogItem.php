<?php

namespace victor\training\ddd\agile;

use Exception;

class ProductBacklogItem
{
    private int $id;
    private string $title;
    private string $description;
    private int $productId;

    private int $version; // for optimistic locking

    public function __construct(int $productId)
    {
        $this->productId = $productId;
    }


    public function getProductId(): int
    {
        return $this->productId;
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
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

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): ProductBacklogItem
    {
        $this->version = $version;
        return $this;
    }

}
