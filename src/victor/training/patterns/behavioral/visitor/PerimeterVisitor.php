<?php

namespace victor\training\patterns\behavioral\visitor;

use victor\training\patterns\behavioral\visitor\model\Circle;
use victor\training\patterns\behavioral\visitor\model\Square;
use victor\training\patterns\behavioral\visitor\model\ShapeVisitor;

class PerimeterVisitor implements ShapeVisitor
{

    private float $totalPerimeter = 0;

    function visitSquare(Square $square): void
    {
        $this->totalPerimeter += 4 * $square->getEdge();
    }

    function visitCircle(Circle $circle): void
    {
        $this->totalPerimeter += 2 * 3.1415 * $circle->getRadius();
    }
}