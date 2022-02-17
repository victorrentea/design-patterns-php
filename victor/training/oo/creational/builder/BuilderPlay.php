<?php
namespace training\oo\creational\builder;

include "Customer.php";
include "Address.php";


// $customer = (new Customer())
//     ->setName('John Doe')
//     ->setLabels(['Label1']);

// trebuie sters!
$customer = (new CustomerBuilder())
    ->withName("John")
    ->withLabels(["John"])
    ->build();

$address = new Address();
$address->setStreetName('Viorele');
$address->setStreetNumber(4);
$address->setCity('Bucharest');
$customer->setAddress($address);

class CustomerBuilder {
    private string $name;
    private string $phone = 'PHONE';
    /* @var String[] */
    private array $labels = array();
    private Address $address;
    private \DateTime $createDate;

    function withName(string $name):CustomerBuilder {
        $this->customer->setName($name); // forma 1 NU MERITA : poti returna this din setter.
        $this->name=$name; // forma 2 pt a ascunde un ctor criminal de mare./ > HINT ca entitatea ta e prea ,mare!
        return $this;
    }
    /** @param string[] */
    function withLabels(array $labels):CustomerBuilder {
        $this->labels = $labels;
        return $this;
    }
    function build():Customer {
        return new Customer($this->name, $this->phone,$this->labels, $this->address, $this->createDate);
    }
}
