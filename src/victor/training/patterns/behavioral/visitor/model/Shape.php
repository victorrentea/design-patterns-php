<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 11:25 AM
 */

namespace victor\training\patterns\behavioral\visitor\model;


use victor\training\patterns\behavioral\visitor\model\ShapeVisitor;

interface Shape
{
    function accept(ShapeVisitor $visitor);
}