<?php

namespace victor\training\ddd\agile;

interface BacklogItemRepo
{
    function save(BacklogItem $backlogItem): BacklogItem;

    public function findOneById(int $id): BacklogItem;

    public function deleteById(int $id): void;
}