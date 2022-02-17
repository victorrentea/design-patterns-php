<?php

namespace victor\training\oo\structural\service;

use victor\training\oo\structural\facade\Customer;
use victor\training\oo\structural\facade\CustomerDto;

class RegisterCustomerService
{ // Domain Service (DDD)
    public function registerCustomer(Customer $customer): void
    {

        // logica
        // logica
        // logica
        // logica
        // logica
        // logica
        $discountPercentage = $customer->getDiscountPercentage();

        echo "Acord discount $discountPercentage";
        // logica
        // logica
        // logica
        // logica
        // logica
    }

}