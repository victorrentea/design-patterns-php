<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 12:42 AM
 */

namespace victor\training\oo\behavioral\visitor;


use victor\training\oo\behavioral\visitor\model\Circle;
use victor\training\oo\behavioral\visitor\model\Elipsa;
use victor\training\oo\behavioral\visitor\model\Shape;
use victor\training\oo\behavioral\visitor\model\Square;

interface ShapeVisitor
{
    function visitCircle(Circle $circle);
    function visitSquare(Square $circle);

    function visitElipsa(Elipsa $param);

}