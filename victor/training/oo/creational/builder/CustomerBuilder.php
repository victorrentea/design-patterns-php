<?php


namespace training\oo\creational\builder;


// Object Mother
class TestData {

    public static function aOrder()
    {

    }
    public static function aProduct()
    {

    }
    public static function aCustomer()
    {
        return (new Customer())
            ->setPhone("default phone")
            ->setPhone("default phone")
            ->setPhone("default phone")
            ->setName("Jane Doe")
            ->setPhone("default phone")
            ->setPhone("default phone")
            ->setPhone("default phone");
    }
}

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
    public function withPhone(string $string):self
    {
        $this->customer->setPhone($string);
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
    public function buildWithDefaultSettings(): Customer
    {
        return $this->customer
            ->setPhone("defalt phone");
    }

//    public function persist()
//    {
////        obtin de undeva entity manger si dau .save pe customer
//    }
}