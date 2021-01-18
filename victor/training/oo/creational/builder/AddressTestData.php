<?php


namespace training\oo\creational\builder;


class AddressTestData
{

    public static function defaultAddress()
    {
        return (new Address())
            ->setStreetName("Viorele")
            ->setStreetNumber(4)
            ->setCity(4);
    }
}