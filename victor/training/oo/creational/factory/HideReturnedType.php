<?php


namespace victor\training\oo\creational\factory;


class HideReturnedType
{
    function createJocConstuctii(int $buget): JocConstructii {
        if ($buget > 100) {
            return new Lego();
        } else {
            return new MegaBlocks();
        }
    }

}


interface JocConstructii {

}

class Lego implements  JocConstructii
{

}

class MegaBlocks implements JocConstructii
{

}