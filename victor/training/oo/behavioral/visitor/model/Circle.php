<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 12:43 AM
 */

namespace victor\training\oo\behavioral\visitor\model;


use JetBrains\PhpStorm\Pure;

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

    public function computeArea(): float
    {
        // Pure = nu side effects + se poate inlocui cu rezultatul apelului ei
        return $this->getRadius() * $this->getRadius() * pi();
    }

}