<?php

namespace victor\training\oo\modularizare\customer\domain;

use victor\training\oo\modularizare\customer\api\message\RequoteCustomerCommand;
use victor\training\oo\modularizare\customer\EventDispatcherInterface;
use victor\training\oo\modularizare\insurance\domain\InsuranceService;

class CustomerService
{
    private CustomerRepo $customerRepo;
    protected EventDispatcherInterface $dispatcher;


    function updateAddress(int $id, string $address)
    {
        $customer = $this->customerRepo->findById($id);
        $customer->address = $address;

        // fire and forget

        // Command pattern (ii spui ce sa faca cuuiva ) sunt mai tighly coupled decat eventuri
        $this->dispatcher->dispatch('requote.customer', new RequoteCustomerCommand());

        // $this->dispatcher->dispatch('customer.address.changed', new CustomerAddressChangedEvent());

    }
}