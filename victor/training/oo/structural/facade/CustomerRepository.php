<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 12:42 PM
 */

namespace victor\training\oo\structural\facade;


use victor\training\oo\structural\facade\dto\CustomerSearchResult;

class CustomerRepository
{


    public function findById(int $customerId):Customer
    {
    // TODO
    }

    /** @return CustomerSearchResult[] */
    public function search(dto\CustomerSearchCriteria $searchCriteria): array
    {
        return [] ;// todo
    }
}