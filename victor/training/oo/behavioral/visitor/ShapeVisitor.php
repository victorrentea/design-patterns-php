<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 12:42 AM
 */

namespace victor\training\oo\behavioral\visitor;


use victor\training\oo\behavioral\visitor\model\Circle;

interface ShapeVisitor
{
    public function visitCircle(Circle $circle);

    public function visitSquare(model\Square $param);

}