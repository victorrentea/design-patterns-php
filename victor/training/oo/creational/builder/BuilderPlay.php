<?php
namespace training\oo\creational\builder;

include "Customer.php";
include "Address.php";


$customer = (new Customer())
    ->setName('John Doe')
    ->addLabels('Label1', 'Label2')
    ->setAddress((new Address())
        ->setStreetName("Viorele")
        ->setStreetNumber(4)
        ->setCity(4)
    );

$customer1 = TestData::aCustomer()
    ->setPhone("SPecial");

$customer1->setAddress(AddressTestData::defaultAddress());

//$customer = (new CustomerBuilder())
//    ->withName('John Doe')
//    //->withLabels(['Label1']);
//    ->withAddress((new AddressBuilder())
//        ->withStreetName("Viorele")
//        ->withStreetNumber(4)
//        ->withCity(4)
//        ->build()
//    )
//    ->persist();

