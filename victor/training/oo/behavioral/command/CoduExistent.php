<?php

namespace victor\training\oo\behavioral\command;

class CoduExistent
{

    static function stuff1(int $p)
    {
        $v = 2 + $p;
        ESMapper::stuff($v);

    }

    static function stuff2()
    {
        ESMapper::stuff(3);
    }

}