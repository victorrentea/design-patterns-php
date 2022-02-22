<?php

namespace victor\training\ddd\agile\domain\repo;

use victor\training\ddd\agile\Product;

interface ProductRepo
{
    public function findOneById(int $productId): Product;

    public function save(Product $product): Product;

    public function existsByCode(string $code): bool;
}