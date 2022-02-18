<?php

namespace victor\training\oo\modularizare\insurance\application;

use victor\training\oo\modularizare\customer\api\CustomerApi;
use victor\training\oo\modularizare\insurance\domain\CustomerClientAdapterInterface;
use victor\training\oo\modularizare\insurance\domain\CustomerVO;

class CustomerClientAdapter implements  CustomerClientAdapterInterface// TODO adapter interface
{
    private CustomerApi $customerApi;

    public function getCustomer(int $customerId): CustomerVO
    {
        $dto = $this->customerApi->fun($customerId);
        $vo = new CustomerVO();
        $vo->name =$dto->name;// etc
        return $vo;
    }
}