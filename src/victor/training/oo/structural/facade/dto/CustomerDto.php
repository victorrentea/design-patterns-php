<?php

namespace victor\training\oo\structural\facade\dto;

// JSON
class CustomerDto
{
    private string $name;
    private string $email;
    private string $address;

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