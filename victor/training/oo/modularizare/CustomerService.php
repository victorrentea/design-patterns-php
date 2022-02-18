<?php

namespace victor\training\oo\modularizare;

use MS\ExamplePHP\ObserverPattern\Service\InvoiceService;

class CustomerService
{
    private InsuranceService $insuranceService;
    private CustomerRepo $customerRepo;
    function updateAddress(int $id, string $address)
    {
        $customer = $this->customerRepo->findById($id);
        $customer->address = $address;

        $this->insuranceService->requoteCustomer($customer);
    }
}