<?php

namespace victor\training\ddd\agile;

interface BacklogItemRepo
{
    function save(ProductBacklogItem $backlogItem): ProductBacklogItem;

    public function findOneById(int $id): ProductBacklogItem;

    public function deleteById(int $id): void;
}