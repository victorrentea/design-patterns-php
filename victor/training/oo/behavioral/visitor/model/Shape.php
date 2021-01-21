<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 11:25 AM
 */

namespace victor\training\oo\behavioral\visitor\model;


use victor\training\oo\behavioral\visitor\ShapeVisitor;

interface Shape
{
    // public function computeArea(): float;

    function accept(ShapeVisitor $visitor):void;
}