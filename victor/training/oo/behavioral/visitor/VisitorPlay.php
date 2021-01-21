<?php


namespace victor\training\oo\behavioral\visitor;

include "model\Shape.php";
include "model\Circle.php";
include "model\Square.php";


use victor\training\oo\behavioral\visitor\model\Circle;
use victor\training\oo\behavioral\visitor\model\Shape;
use victor\training\oo\behavioral\visitor\model\Square;

$shapes = [new Square(2), new Circle(2)];


// TODO: aria total a formelor.

$total =0;
foreach ($shapes as $shape) {
    $total += $shape->computeArea();

}

echo "Aria totala : $total";
