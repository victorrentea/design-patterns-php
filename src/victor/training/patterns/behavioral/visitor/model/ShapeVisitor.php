<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 12:42 AM
 */

namespace victor\training\patterns\behavioral\visitor\model;


use victor\training\patterns\behavioral\visitor\model\Circle;
use victor\training\patterns\behavioral\visitor\model\Square;

interface ShapeVisitor
{
    function visitCircle(Circle $circle): void;

    function visitSquare(Square $square): void;
}