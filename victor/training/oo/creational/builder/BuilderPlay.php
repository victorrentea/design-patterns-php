<?php
namespace training\oo\creational\builder;

include "Customer.php";
include "Address.php";



;
$labels = [];
$labels []= 'Label1';
$customer->setLabels($labels);

$address = new Address();
$address->setStreetName('Viorele');
$address->setStreetNumber(4);
$address->setCity('Bucharest');

$customer = (new Customer())
    ->setName('John Doe')
    ->addLabel("label")
    ->setAddress($address);

$customer = (new CustomerBuilder())
    ->withName("name") // return CustomerBuilder
    ->withAddres($address) // return CustomerBuilder
    ->addLabel("label")
    ->make(); // return Customer


