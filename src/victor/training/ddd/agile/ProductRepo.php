<?php

namespace victor\training\ddd\agile;

interface ProductRepo
{
    public function findOneById(int $productId): Product;

    public function save(Product $product): Product;

    public function existsByCode(string $code): bool;
}