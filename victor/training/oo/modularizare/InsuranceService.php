<?php

namespace victor\training\oo\modularizare;

class InsuranceService
{
private InsurancePolicyRepo $insurancePolicyRepo;
    public function requoteCustomer(Customer $customer)
    {
        $policy = $this->insurancePolicyRepo->findByCustomerId($customer->id);
        if ($customer->address === "Pakistan") {
            $policy->value += 100;
        }
    }

    function displayPolicy(int $id):InsurancePolicyDto
    {
        $policy = $this->insurancePolicyRepo->findId($id);
        $dto = new InsurancePolicyDto();
        $dto->address =  $policy->customer->address;
        return $dto;
    }


}