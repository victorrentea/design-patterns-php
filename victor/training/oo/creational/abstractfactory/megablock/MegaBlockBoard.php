<?php


namespace victor\training\oo\creational\abstractfactory\megablock;


use victor\training\oo\creational\abstractfactory\spi\Board;
use victor\training\oo\creational\abstractfactory\spi\Cube;

class MegaBlockBoard implements Board
{


    function __toString()
    {
        return "Mega Board";
    }
}