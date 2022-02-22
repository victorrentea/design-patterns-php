<?php

namespace victor\training\ddd\agile;

class AddBacklogItemRequest
{
    public int $productBacklogId;
    public int $fpEstimation;
}