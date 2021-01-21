<?php


namespace victor\training\oo\behavioral\visitor;

include "model\Shape.php";
include "model\Circle.php";
include "model\Square.php";
include "ShapeVisitor.php";


use victor\training\oo\behavioral\visitor\model\Circle;
use victor\training\oo\behavioral\visitor\model\Elipsa;
use victor\training\oo\behavioral\visitor\model\Shape;
use victor\training\oo\behavioral\visitor\model\Square;

/** @var Shape[] $shapes */
$shapes = [new Square(2), new Circle(2)];



class AreaVisitor implements ShapeVisitor
{
    private float $totalArea = 0;

    public function getTotalArea(): float
    {
        return $this->totalArea;
    }

    function visitCircle(Circle $shape): void
    {
        $this->totalArea += $this->computeCircleArea($shape);
    }
    function visitSquare(Square $shape): void
    {
        $this->totalArea += $this->computeSquareArea($shape);
    }

    private function computeCircleArea(Circle $shape): float|int
    {
        foreach ($shape->getSubShapes() as $subShape) {
            $subShape->accept($this);
        }
        return $shape->getRadius() * $shape->getRadius() * pi();
    }

    private function computeSquareArea(Square $shape): float|int
    {
        return $shape->getEdge() * $shape->getEdge();
    }

    function visitElipsa(Elipsa $param)
    {
       // logica spec pentru Elipsa
    }
}

// TODO: aria total a formelor.

$shapeVisitor = new AreaVisitor();
foreach ($shapes as $shape) {
    $shape->accept($shapeVisitor);
    // $shape->accept($shapeVisitor);
}

echo "Aria totala : " . $shapeVisitor->getTotalArea();

