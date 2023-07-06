<?php

namespace victor\training\patterns\behavioral\visitor;

use victor\training\patterns\behavioral\visitor\model\Circle;
use victor\training\patterns\behavioral\visitor\model\Shape;
use victor\training\patterns\behavioral\visitor\model\Square;

include "model/Shape.php";
include "model/Circle.php";
include "model/Square.php";
include "model/ShapeVisitor.php";
include "AreaVisitor.php";
include "PerimeterVisitor.php";

$shapes = [new Circle(2), new Square(4)];
$areaVisitor = new AreaVisitor();
/* @var $shape Shape */
foreach ($shapes as $shape) {
    $shape->accept($areaVisitor);
}
echo "Area = " . $areaVisitor->getTotalArea();

