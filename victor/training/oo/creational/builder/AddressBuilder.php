<?php


namespace training\oo\creational\builder;


class AddressBuilder
{
    private Address $address;

    public function __construct()
    {
        $this->address = new Address();
    }

    public function withStreetName(string $streetName): self
    {
        $this->address->setStreetName($streetName);
        return $this;
    }

    public function withCity(string $city): self
    {
        $this->address->setCity($city);
        return $this;
    }

    public function withStreetNumber(int $streetNumber):self
    {
        $this->address->setStreetNumber($streetNumber);
        return $this;
    }

    public function build()
    {
        return $this->address;
    }
}