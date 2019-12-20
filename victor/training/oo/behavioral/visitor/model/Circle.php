<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 12:43 AM
 */

namespace victor\training\oo\behavioral\visitor\model;


class Circle implements Shape
{
    /** @var  int */
    private $radius;

    public function __construct(int $radius)
    {
        $this->radius = $radius;
    }

    public function getRadius(): int
    {
        return $this->radius;
    }


}