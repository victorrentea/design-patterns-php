<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 12:43 AM
 */

namespace victor\training\patterns\behavioral\visitor\model;


use victor\training\patterns\behavioral\visitor\model\ShapeVisitor;

class Circle implements Shape
{
    private int $radius;

    public function __construct(int $radius)
    {
        $this->radius = $radius;
    }

    public function getRadius(): int
    {
        return $this->radius;
    }


    function accept(ShapeVisitor $visitor)
    {
        $visitor->visitCircle($this);
    }
}