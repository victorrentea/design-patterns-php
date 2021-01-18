<?php


namespace training\oo\creational\builder;


class CustomerBuilder
{

    private Customer $customer;

    public function __construct()
    {
        $this->customer = new Customer();
    }

    public function withName(string $string):self
    {
        $this->customer->setName($string);
        return $this;
    }

    public function withAddress(Address $address): CustomerBuilder
    {
        $this->customer->setAddress($address);
        return $this;
    }

    public function build(): Customer
    {
        return $this->customer;
    }
}