<?php


namespace victor\training\oo\behavioral\command;

class CreateBeerCommand implements  ICommand
{

    public function __construct(private Barman $barman, private string $beerType)
    {
    }

    public function getBeerType(): string
    {
        return $this->beerType;
    }

    function execute()
    {
        $this->barman->pourBeer($this->getBeerType());
    }
}