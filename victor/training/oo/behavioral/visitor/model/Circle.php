<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 12:43 AM
 */

namespace victor\training\oo\behavioral\visitor\model;


use JetBrains\PhpStorm\Pure;
use victor\training\oo\behavioral\visitor\ShapeVisitor;

// imagine this is generated code. Model you DO NOT control!
class Circle implements Shape
{
    private int $radius;

    private array $subShapes = [];

    /**
     * @return Shape[]
     */
    public function getSubShapes(): array
    {
        return $this->subShapes;
    }
    public function __construct(int $radius)
    {
        $this->radius = $radius;
    }

    public function getRadius(): int
    {
        return $this->radius;
    }

    // public function computeArea(): float
    // {
    // LOGICA COMUNA
    // LOGICA COMUNA
    // LOGICA COMUNA

    //     // Heavy logic. Bazata doar pe campurile mele, nu trisez, nu ma duc in DB, retea, cozi.
    //     // Pure = nu side effects + se poate inlocui cu rezultatul apelului ei
    //     return $this->getRadius() * $this->getRadius() * pi();
    // }

    function accept(ShapeVisitor $visitor): void
    {
        $visitor->visitCircle($this);
    }
}
// imagine this is generated code. Model you DO NOT control!
class Elipsa implements Shape
{
    private int $radius;

    private array $subShapes = [];

    /**
     * @return Shape[]
     */
    public function getSubShapes(): array
    {
        return $this->subShapes;
    }
    public function __construct(int $radius)
    {
        $this->radius = $radius;
    }

    public function getRadius(): int
    {
        return $this->radius;
    }

    // public function computeArea(): float
    // {
    // LOGICA COMUNA
    // LOGICA COMUNA
    // LOGICA COMUNA

    //     // Heavy logic. Bazata doar pe campurile mele, nu trisez, nu ma duc in DB, retea, cozi.
    //     // Pure = nu side effects + se poate inlocui cu rezultatul apelului ei
    //     return $this->getRadius() * $this->getRadius() * pi();
    // }

    function accept(ShapeVisitor $visitor): void
    {
        $visitor->visitElipsa($this);
    }
}