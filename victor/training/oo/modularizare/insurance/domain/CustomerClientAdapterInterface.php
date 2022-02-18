<?php

namespace victor\training\oo\modularizare\insurance\domain;

interface CustomerClientAdapterInterface
{

    public function getCustomer(int $customerId):CustomerVO;
}