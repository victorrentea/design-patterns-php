<?php

namespace victor\training\patterns\behavioral\visitor;

use victor\training\patterns\behavioral\visitor\model\Circle;
use victor\training\patterns\behavioral\visitor\model\Square;
use victor\training\patterns\behavioral\visitor\model\ShapeVisitor;

class AreaVisitor implements ShapeVisitor
{
    private float $totalArea = 0;

    function visitSquare(Square $square): void
    {
        $this->totalArea += $square->getEdge() * $square->getEdge();
    }

    function visitCircle(Circle $circle): void
    {
        $this->totalArea += 3.1415 * $circle->getRadius() * $circle->getRadius() ;
    }

    public function getTotalArea(): float
    {
        return $this->totalArea;
    }
}