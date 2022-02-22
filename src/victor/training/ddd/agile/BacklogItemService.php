<?php

namespace victor\training\ddd\agile;

class BacklogItemService
{
    private BacklogItemRepo $backlogItemRepo;
    private ProductRepo $productRepo;

    public function __construct(BacklogItemRepo $backlogItemRepo, ProductRepo $productRepo)
    {
        $this->backlogItemRepo = $backlogItemRepo;
        $this->productRepo = $productRepo;
    }

    public function createBacklogItem(BacklogItemDto $dto): int
    {
        $product = $this->productRepo->findOneById($dto->productId);
        $backlogItem = (new ProductBacklogItem())
            ->setDescription($dto->description)
            ->setTitle($dto->title);
        $product->addBacklogItem($backlogItem);

        return $this->backlogItemRepo->save($backlogItem)->getId();
    }

    public function getBacklogItem(int $id): BacklogItemDto
    {
        $backlogItem = $this->backlogItemRepo->findOneById($id);
        $dto = new BacklogItemDto();
        $dto->id = $backlogItem->getId();
        $dto->productId = $backlogItem->getSprint()->getProductId();
        $dto->description = $backlogItem->getDescription();
        $dto->title = $backlogItem->getTitle();
        $dto->version = $backlogItem->getVersion();
        return $dto;
    }

    public function updateBacklogItem(BacklogItemDto $dto): void
    {
        $oldItem = $this->backlogItemRepo->findOneById($dto->id);
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
        $this->backlogItemRepo->deleteById($id);
    }
}