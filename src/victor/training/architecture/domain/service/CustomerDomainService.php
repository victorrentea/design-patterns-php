<?php

namespace victor\training\architecture\domain\service;

use victor\training\architecture\domain\model\Customer;
use victor\training\architecture\domain\model\CustomerHelper;

class CustomerDomainService
{
    // nici un picior de api model aici, doar structuri -ale mele

    public function registerCustomerDomain(Customer $customer): void
    {
// business logic
        // business logic
        // business logic
        // business logic
        $d = $customer->getDiscountPercentage();
        echo "Biz logic with $d";
        // business logic
        // business logic
        //sigur in alta parte mai e inca o data:
        $d = CustomerHelper::getDiscountPercentage($customer);
        // business logic
        $this->customerRepository->save($customer);
    }
}