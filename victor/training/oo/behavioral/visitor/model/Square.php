<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 11:26 AM
 */

namespace victor\training\oo\behavioral\visitor\model;



use victor\training\oo\behavioral\visitor\ShapeVisitor;

class Square implements Shape
{
    private int $edge;

    public function __construct(int $edge)
    {
        $this->edge = $edge;
    }

    public function getEdge(): int
    {
        return $this->edge;
    }

    function accept(ShapeVisitor $visitor)
    {
        $visitor->visitSquare($this);
    }
}