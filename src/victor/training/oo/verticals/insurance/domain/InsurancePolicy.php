<?php

namespace victor\training\oo\verticals\insurance\domain;

class InsurancePolicy
{
    public int $id;

    // public Customer $customer; // 1) Entity links !??
    // tai link si pui ID doar
    public int $customerId;
    // public string $customerAddress;

    // daca insa ai de accesat des anumite campuri din Customer si asta cere network call.
    // ... sau cache
    // dar horror anyway caci Eventual Cosnsitency
    // public CustomerVO $customer; // si date copiate din Customerul original

    public int $value;
    public string $createDate;
    //...
}