<?php


namespace victor\training\oo\behavioral\command;


class Barman
{

    public function pourBeer(string $beerType)
    {
        printf(" Pouring beer " . $beerType . " ...  ");
        sleep(1);
        printf("Done\n");
    }
}