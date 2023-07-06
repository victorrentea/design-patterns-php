<?php

namespace victor\training\architecture\domain\model;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

#[Entity]
class Customer
{
    #[Id]
    #[GeneratedValue]
    private int $id;
    private string $name;
    private string $email;
    private string $address;
    private bool $genius;


    public function getId(): int
    {
        return $this->id;
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