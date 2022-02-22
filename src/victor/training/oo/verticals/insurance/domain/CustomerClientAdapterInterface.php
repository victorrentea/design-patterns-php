<?php

namespace victor\training\oo\verticals\insurance\domain;

interface CustomerClientAdapterInterface
{

    public function getCustomer(int $customerId):CustomerVO;
}