<?php

namespace victor\training\patterns\verticals\insurance\domain;

interface CustomerClientAdapterInterface
{

    public function getCustomer(int $customerId):CustomerVO;
}