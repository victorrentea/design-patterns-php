<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 06-Mar-18
 * Time: 12:51 PM
 */

namespace victor\training\oo\structural\facade;


class Customer // cea mai sfanta clasa din sistemul tau
{
    private String $name;
    private String $phone;
    private String $address;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Customer
    {
        $this->name = $name;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): Customer
    {
        $this->phone = $phone;
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): Customer
    {
        $this->address = $address;
        return $this;
    }

    public function isGenius(): bool
    {
        return true;
    }

    public function getDiscountPercentage(): int
    {
        if ($this->isGenius()) {
            return 4;
        } else {
           return 3;
        }
    }


}