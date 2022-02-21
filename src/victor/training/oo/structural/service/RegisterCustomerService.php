<?php

namespace victor\training\oo\structural\service;

class RegisterCustomerService
{ // Domain Service
    public function registerCustomer(Customer $customer): void
    {
        // business logic
        // business logic
        // business logic
        // business logic
        // business logic
        // business logic

        $discountPercentage = $customer->getDiscountPercentage();

        echo "Biz logic with $discountPercentage";
        // business logic
        // business logic
        // business logic
    }

}