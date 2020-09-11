<?php


namespace victor\training\oo\creational\abstractfactory\megablock;



use victor\training\oo\creational\abstractfactory\spi\BlockFactory;
use victor\training\oo\creational\abstractfactory\spi\Board;
use victor\training\oo\creational\abstractfactory\spi\Cube;

class MegaBlockFactory implements BlockFactory
{

    function createCube(): Cube
    {
        return new MegaBlockCube();
    }

    function createBoard(): Board
    {
       return new MegaBlockBoard();
    }

    function __toString()
    {
        return "";
    }
}