<?php

namespace victor\training\ddd\agile\domain\repo;

use victor\training\ddd\agile\Sprint;

interface SprintRepo
{

    public function save(Sprint $sprint): Sprint;

    public function findOneById(int $id): Sprint;
}