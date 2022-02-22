<?php

namespace victor\training\ddd\agile\application\dto;

class LogHoursRequest
{
    public int $sprintBacklogItemId;
    public int $hours;
}