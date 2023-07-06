<?php

namespace victor\training\patterns\verticals\insurance\domain;

use victor\training\patterns\verticals\customer\api\message\RequoteCustomerCommand;
use victor\training\patterns\verticals\customer\domain\CustomerRepo;
use victor\training\patterns\verticals\insurance\EventDispatcherInterface;

class InsuranceService
{
    private InsurancePolicyRepo $insurancePolicyRepo;
    // private CustomerRepo $customerRepo;
    private EventDispatcherInterface $dispatcher;

    public function __construct(InsurancePolicyRepo $insurancePolicyRepo, CustomerRepo $customerRepo, EventDispatcherInterface $dispatcher)
    {
        $this->insurancePolicyRepo = $insurancePolicyRepo;
        $this->customerRepo = $customerRepo;
        $this->dispatcher = $dispatcher;

        $dispatcher->addListener('requote.customer',  [$this, 'requoteCustomer']);

    }


    public function requoteCustomer(RequoteCustomerCommand $command)
    {
        $policy = $this->insurancePolicyRepo->findByCustomerId($command->customerId);
        if ($command->newAddress === "Pakistan") {
            $policy->value += 100;
        }
        // $policy->customerAddress = $command->newAddress;
    }

    function displayPolicy(int $id): InsurancePolicyDto
    {
        $policy = $this->insurancePolicyRepo->findId($id);
        $dto = new InsurancePolicyDto();
        $dto->id = $policy->id;

        $customerVO = $this->adapter->getCustomer($policy->customer->id); // simplu

        // $customer = $this->customerRepo->findById($policy->customerId);
        $dto->customerName = $customerVO->name;
        $dto->address = $customerVO->address;
        return $dto;
    }

    private CustomerClientAdapterInterface $adapter; // REST pe sub

}