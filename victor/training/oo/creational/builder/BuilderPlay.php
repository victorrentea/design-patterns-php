<?php
namespace training\oo\creational\builder;

include "Customer.php";
include "Address.php";


$customer = (new Customer())
    ->setName('John Doe')
    ->setLabels(['Label1']);

// trebuie sters!
// $customer = (new CustomerBuilder())
//     ->withName("John")
//     ->withLabels(["John"])
//     ->build();

$address = new Address();
$address->setStreetName('Viorele');
$address->setStreetNumber(4);
$address->setCity('Bucharest');
$customer->setAddress($address);


class CustomerBuilder {
    private Customer $customer;

    function withName(string $name):CustomerBuilder {
        $this->customer->setName($name); // forma 1
        return $this;
    }
    /** @param string[] */
    function withLabels(array $labels):CustomerBuilder {
        $this->customer->setLabels($labels);
        return $this;
    }
    function build():Customer {
        return $this->customer;
    }
}