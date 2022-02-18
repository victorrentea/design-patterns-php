<?php

namespace victor\training\oo\behavioral\visitor;

use victor\training\oo\behavioral\visitor\model\Circle;

class PerimeterVisitor implements ShapeVisitor
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

    public function visitRectangle(model\Rectangle $param)
    {
        // TODO: Implement visitRectangle() method.
    }
}





