<?php

namespace victor\training\oo\modularizare\customer\domain;

use victor\training\oo\modularizare\customer\api\message\RequoteCustomerCommand;
use victor\training\oo\modularizare\customer\EventDispatcherInterface;

class CustomerService
{
    private CustomerRepo $customerRepo;
    protected EventDispatcherInterface $dispatcher;


    function updateAddress(int $id, string $address)
    {
        $customer = $this->customerRepo->findById($id);
        $customer->address = $address;

        $this->dispatcher->dispatch('requote.customer',
            new RequoteCustomerCommand());

    }
}