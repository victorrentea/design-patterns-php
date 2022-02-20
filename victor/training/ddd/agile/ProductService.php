<?php

namespace victor\training\ddd\agile;


class ProductDto
{
    public int $id;
    public string $code;
    public string $name;
    public string $mailingList;
}

interface ProductRepo
{
    public function findOneById(int $productId): Product;

    public function save(Product $product): Product;

    public function existsByCode(string $code): bool;
}
class ProductService
{
    private ProductRepo $productRepo;

    public function __construct(ProductRepo $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function createProduct(ProductDto $dto): int
    {
        if ($this->productRepo->existsByCode($dto->code)) {
            throw new \Exception("Code already defined");
        }
        $product = (new Product())
            ->setCode($dto->code)
            ->setName($dto->name)
            ->setTeamMailingList($dto->mailingList);
        return $this->productRepo->save($product)->getId();
    }

    public function getProduct(int $id): ProductDto
    {
        $product = $this->productRepo->findOneById($id);
        $productDto = new ProductDto();
        $productDto->id = $product->getId();
        $productDto->name = $product->getName();
        $productDto->code = $product->getCode();
        $productDto->mailingList = $product->getTeamMailingList();
        return $productDto;
    }
}