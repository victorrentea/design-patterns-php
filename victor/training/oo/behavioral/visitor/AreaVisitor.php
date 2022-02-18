<?php

namespace victor\training\oo\behavioral\visitor;

use victor\training\oo\behavioral\visitor\model\Circle;

class AreaVisitor implements ShapeVisitor
{
    public float $total=0;
    public function visitCircle(Circle $circle)
    {
        $this->total += $circle->getRadius()*$circle->getRadius() * M_PI;
    }

    public function visitSquare(model\Square $square)
    {
        $this->total += $square->getEdge() * $square->getEdge();
    }
}