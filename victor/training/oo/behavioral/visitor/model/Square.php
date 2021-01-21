<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 11:26 AM
 */

namespace victor\training\oo\behavioral\visitor\model;


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

    public function computeArea(): float
    {
        return $this->getEdge() * $this->getEdge();
    }
}