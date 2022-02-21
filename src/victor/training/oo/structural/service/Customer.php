<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 06-Mar-18
 * Time: 12:51 PM
 */

namespace victor\training\oo\structural\service;

// @Entity
class Customer
{
    private string $name;
    private string $email;
    private string $address;
    private bool $genius;

    public function __construct(string $email)
    {
        if (!$email) {
            throw new \Exception("Bum");
        }
        $this->email = $email;
    }


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

    public function getDiscountPercentage(): int
    {
        // Feature Envy code smell: logica mica de biz care lucreaza doar pe date ale unei entitati
        $discountPercentage = 3;
        if ($this->isGenius()) {
            $discountPercentage = 4;
        }
        return $discountPercentage;
    }


}