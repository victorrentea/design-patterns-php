<?php

namespace victor\training\architecture\application\dto;

// JSON
use victor\training\architecture\domain\model\Customer;

class CustomerDto
{
    private string $name;
    private string $email;
    private string $address;


    public function __construct(Customer $customer) // am cuplat gunoiu (API MODEL) la cele sfinte (ENTITY MODEL)
    {
        $this->name = $customer->getName();
        $this->setEmail($customer->getEmail());
        $this->setAddress($customer->getAddress());
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CustomerDto
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): CustomerDto
    {
        $this->email = $email;
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): CustomerDto
    {
        $this->address = $address;
        return $this;
    }

}