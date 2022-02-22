<?php

namespace victor\training\ddd\agile\application\service;

use victor\training\ddd\agile\application\dto\ProductBacklogItemDto;
use victor\training\ddd\agile\domain\repo\ProductBacklogItemRepo;
use victor\training\ddd\agile\domain\repo\ProductRepo;
use victor\training\ddd\agile\ProductBacklogItem;

class ProductBacklogItemFacade
{
    private ProductBacklogItemRepo $productBacklogItemRepo;
    private ProductRepo $productRepo;

    public function __construct(ProductBacklogItemRepo $backlogItemRepo, ProductRepo $productRepo)
    {
        $this->productBacklogItemRepo = $backlogItemRepo;
        $this->productRepo = $productRepo;
    }

    public function createBacklogItem(ProductBacklogItemDto $dto): int
    {
        $product = $this->productRepo->findOneById($dto->productId);
        $productBacklogItem = (new ProductBacklogItem($dto->productId))
            ->setDescription($dto->description)
            ->setTitle($dto->title);
        $product->addBacklogItem($productBacklogItem);

        return $this->productBacklogItemRepo->save($productBacklogItem)->getId();
    }

    public function getBacklogItem(int $id): ProductBacklogItemDto
    {
        $backlogItem = $this->productBacklogItemRepo->findOneById($id);
        $dto = new ProductBacklogItemDto();
        $dto->id = $backlogItem->getId();
        $dto->productId = $backlogItem->getProductId();
        $dto->description = $backlogItem->getDescription();
        $dto->title = $backlogItem->getTitle();
        $dto->version = $backlogItem->getVersion();
        return $dto;
    }

    public function updateBacklogItem(ProductBacklogItemDto $dto): void
    {
        $oldItem = $this->productBacklogItemRepo->findOneById($dto->id);
        $oldItem->setDescription($dto->description)
                ->setTitle($dto->title)
                ->setVersion($dto->version);

        // $backlogItem = (new ProductBacklogItem())
        //     ->setId($dto->id)
        //     ->setProductId($oldItem->getProductId())
        //     // ->setProductId($dto->productId) // TODO nu are sens, nu are voie din API sa modifice
        //     ->setDescription($dto->description)
        //     ->setTitle($dto->title)
        //     ->setVersion($dto->version);

        // $this->backlogItemRepo->save($oldItem); // necesara doar daca nu Doctrine
    }

    public function deleteBacklogItem(int $id): void
    {
        $this->productBacklogItemRepo->deleteById($id);
    }
}