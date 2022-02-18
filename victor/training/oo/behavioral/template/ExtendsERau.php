<?php


namespace victor\training\oo\behavioral\template;

class ExtendsERau
{


}

class Student
{
    function bea()
    {
        if ($this->mamaDaBani()) {
            echo "BEU";
        }
    }

    public function mamaDaBani()
    {
        return false;
    }
}

class StudentLaCS extends Student
{
    public function mamaDaBani() {
        return true;
    }
}