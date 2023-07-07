<?php
namespace victor\training\patterns\creational\builder;

include "Customer.php";
include "Address.php";


$labels = [];
$labels []= 'Label1';
$address = new Address();
$address->setStreetName('Viorele');
$address->setStreetNumber(4);
$address->setCity('Bucharest');

$customer = (new Customer())
    ->setName('John Doe')
    ->setAddress($address)
    ->setLabels($labels);



