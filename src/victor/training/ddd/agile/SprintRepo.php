<?php

namespace victor\training\ddd\agile;

interface SprintRepo
{

    public function save(Sprint $sprint): Sprint;

    public function findOneById(int $id): Sprint;
}