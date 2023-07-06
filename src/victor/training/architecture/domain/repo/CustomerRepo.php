<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 12:42 PM
 */

namespace victor\training\architecture\domain\repo;


use victor\training\architecture\application\dto\CustomerSearchCriteria;
use victor\training\architecture\application\dto\CustomerSearchResult;
use victor\training\architecture\domain\model\Customer;

interface CustomerRepo
{
    public function findById(int $customerId): Customer;

    /** @return CustomerSearchResult[] */
    public function search(CustomerSearchCriteria $searchCriteria): array;
}