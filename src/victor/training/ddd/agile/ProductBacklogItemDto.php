<?php

namespace victor\training\ddd\agile;

class ProductBacklogItemDto
{
    public int $id;
    public int $productId;
    public string $title;
    public string $description;
    public int $version;
}