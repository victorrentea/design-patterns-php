<?php

namespace victor\training\architecture\domain\model;

use Doctrine\ORM\Mapping\Embeddable;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

// NON OOP:
class CustomerHelper
{
    static function getDiscountPercentage(Customer $customer): float
    {
        $discountPercentage = 3;
        if ($customer->isGenius()) {
            $discountPercentage = 4;
        }
        return $discountPercentage;
    }
}

class CustomerContext { // clasa care tine behaviorul asociat DOAR cu Customer model
    private readonly Customer $customer;
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
    function getDiscountPercentage(): float
    {
        if ($this->customer->isGenius()) {
            return 4;
        } else {
            return 3;
        }
    }
}

//#[Entity]
//class GeniusCustomer extends Customer { // foarte heavy
//    private string $cevainPlus;//incepe sa justifice subclasarea
//    private string $cevainPlus;
//    private string $cevainPlus;
//    private string $cevainPlus;
//    function getDiscountPercentage():float {
//        return 4;
//    }
//    function getDiscountPercentage():float {
//        return 4;
//    }
//}
#[Embeddable]
// Value Object = obiect mic din Domain care tine niste date legate intre ele,
// nu are PK persistent
// ideal imutabil
// equals se testeaza camp cu camp
class ContactDetails {
    private string $email;
    private string $address;

    public function __construct(string $email, string $address)
    {
        $this->email = $email;
        $this->address = $address;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}

#[Entity] // domain model care tine datele persistente
class Customer
{
    #[Id]
    #[GeneratedValue]
    private ?int $id;
    private string $name;
//    #[Embedded] ContactDetails $contact;
    private string $email;
    private ?string $address;
    private bool $genius = false;




    // OOP = keep behavior next to state.
    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    function getDiscountPercentage(): float
    {
        // RISK: sa pui tot ce crezi ca tine de customer in clasa asta.
        // problema reala: entitati prea mari eg 40 campuri => Customer god class solutia
        // 1) #[Embeddable] mai scoti din datele legate intre ele in Value Objecturi
        // 2) spargi entitatea -> InvoicingCustomer vs ShippingCustomer entity separate est: 2 luni
        // am ajuns la model mic < 20 campuri
        // REGULI: cand pun logica in Model?
        // A) PUTINA LOGICA 5-10 linii: pui in model atata logica cat sa nu vrei vreodata sa o mockuiesti = putina
        //  -- daca e multa logica --> [Domain] Service
        // B) sa lucreze DOAR CU STAREA MEA = sa nu iei 7 param
        // C) nu pui in Domain Model logica de prezentare/infrastructura : eg formatarea ca un CSV pt un export
        if ($this->genius) {
            return 4;
        } else {
            return 3;
        }
    }

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