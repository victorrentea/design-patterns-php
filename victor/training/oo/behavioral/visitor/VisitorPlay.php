<?php

namespace victor\training\oo\behavioral\visitor;


use victor\training\oo\behavioral\visitor\model\Circle;
use victor\training\oo\behavioral\visitor\model\Shape;
use victor\training\oo\behavioral\visitor\model\Square;

include "ShapeVisitor.php";
include "model\Shape.php";
include "model\Circle.php";
include "model\Square.php";
include "AreaVisitor.php";
/** @var Shape[] $shapes */
$shapes = [new Circle(2), new Square(3)];


$totalArea = 0;
$areaVisitor = new AreaVisitor();
foreach ($shapes as $shape) {
    // $totalArea += $shape->getArea(); // normal ar fi polimorfism

    // dar daca nu ai voie sa moifici clasele, sau NU VREI sa pui logica asta inauntru ca deja e prea mare clasa.
    // if ($shape instanceof Circle) {
    //     $totalArea += $shape->getRadius() * $shape->getRadius() * M_PI;
    // } elseif ($shape instanceof Square) {
    //     $totalArea += $shape->getEdge() * $shape->getEdge();
    // } else {
    //     throw new \Exception("JDD: Doamne-ajuta testerul! Dacca vezi asta, suna-ma 07200019871856");
    // }

    $shape->accept($areaVisitor);
}

$totalArea = $areaVisitor->total;
echo "Total Area = $totalArea\n";


// ai de adaugat logica pe o ierarhie de clase case:
//1) nu le poti modifica
//2) au crescut prea mari si vrei sa SCOTI logica din ele.