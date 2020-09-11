<?php

namespace training\oo\creational\builder;

include "Customer.php";
include "Address.php";;

function f()
{
    $labels = [];
    $labels [] = 'Label1';
//    $customer->setLabels($labels);

    $address = new Address();
    $address->setStreetName('Viorele');
    $address->setStreetNumber(4);
    $address->setCity('Bucharest');

    $customer = (new Customer())
        ->setName('John Doe')
        ->addLabel("label")
        ->setAddress($address);

}

$customer = (new CustomerBuilder())
    ->withName("name") // return CustomerBuilder
    ->withAddress($address) // return CustomerBuilder
    ->withInvalidAddress()
    ->addLabel("label")
    ->make(); // return Customer


