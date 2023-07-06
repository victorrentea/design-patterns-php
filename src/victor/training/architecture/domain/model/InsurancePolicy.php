<?php

namespace victor\training\architecture\domain\model;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
class InsurancePolicy
{
    #[Id]
    #[GeneratedValue]
    private int $id;

    #[ManyToOne]
    private Customer $customer;

    private int $valueInEur;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function getValueInEur(): int
    {
        return $this->valueInEur;
    }

    public function setValueInEur(int $valueInEur): void
    {
        $this->valueInEur = $valueInEur;
    }


}