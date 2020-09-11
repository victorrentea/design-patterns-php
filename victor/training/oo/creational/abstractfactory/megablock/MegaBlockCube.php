<?php


namespace victor\training\oo\creational\abstractfactory\megablock;


use victor\training\oo\creational\abstractfactory\spi\Board;
use victor\training\oo\creational\abstractfactory\spi\Cube;

class MegaBlockCube implements Cube
{

    public function __construct()
    {
    }

    function stackOnto(Cube $cube)
    {
        // TODO: Implement stackOnto() method.
    }

    function stickIn(Board $board)
    {
        // TODO: Implement stickIn() method.
    }

    function __toString()
    {
        return "Mega Cube";
    }
}