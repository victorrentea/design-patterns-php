<?php
namespace training\oo\creational\builder;

include "Customer.php";
include "Address.php";


$customer = (new CustomerBuilder())
->withName('John Doe')
    //->withLabels(['Label1']);
    ->withAddress((new AddressBuilder())
        ->withStreetName("Viorele")
        ->withStreetNumber(4)
        ->withCity(4)
        ->build()
    )
    ->build();
;


$customer->setAddress($address);
