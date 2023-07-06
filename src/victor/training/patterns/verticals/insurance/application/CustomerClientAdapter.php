<?php

namespace victor\training\patterns\verticals\insurance\application;

use victor\training\patterns\verticals\customer\api\CustomerApi;
use victor\training\patterns\verticals\insurance\domain\CustomerClientAdapterInterface;
use victor\training\patterns\verticals\insurance\domain\CustomerVO;

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