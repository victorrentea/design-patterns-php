<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 06-Mar-18
 * Time: 12:51 PM
 */

namespace victor\training\oo\structural\facade;

// @Entity
class Customer
{
    private string $name;
    private string $email;
    private string $address;
    private bool $genius;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Customer
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): Customer
    {
        $this->email = $email;
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
        return $this->genius;
    }

    public function setGenius(bool $genius): Customer
    {
        $this->genius = $genius;
        return $this;
    }



}