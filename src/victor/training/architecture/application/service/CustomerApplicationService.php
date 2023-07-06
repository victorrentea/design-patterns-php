<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 12:44 PM
 */

namespace victor\training\architecture\application\service;


use victor\training\architecture\application\dto\CustomerDto;
use victor\training\architecture\application\dto\CustomerSearchCriteria;
use victor\training\architecture\application\dto\CustomerSearchResult;
use victor\training\architecture\domain\model\Customer;
use victor\training\architecture\domain\model\CustomerHelper;
use victor\training\architecture\domain\repo\CustomerRepo;
use victor\training\architecture\domain\service\InsuranceService;

class CustomerApplicationService
{
    private CustomerRepo $customerRepository;
    private InsuranceService $insuranceService;

    public function __construct(CustomerRepo $customerRepository, \victor\training\architecture\domain\service\InsuranceService $insuranceService)
    {
        $this->customerRepository = $customerRepository;
        $this->insuranceService = $insuranceService;
    }

    /** @return CustomerSearchResult[] */
    function search(CustomerSearchCriteria $searchCriteria): array
    {
        return $this->customerRepository->search($searchCriteria);
    }

    function getCustomerById(int $customerId): CustomerDto
    {
        $customer = $this->customerRepository->findById($customerId);
        $dto = new CustomerDto();
        $dto->setName($customer->getName());
        $dto->setEmail($customer->getEmail());
        $dto->setAddress($customer->getAddress());
        return $dto;
    }


    function registerCustomer(CustomerDto $customerDto): CustomerDto
    {
        $customer = new Customer();
        $customer->setName($customerDto->getName());
        $customer->setEmail($customerDto->getEmail());
        $customer->setAddress($customerDto->getAddress());

        if (! $customer->getEmail()) {
            throw new \Exception("Bum");
        }

        // business logic
        // business logic
        // business logic
        // business logic
        $d = $customer->getDiscountPercentage();
        echo "Biz logic with $d";
        // business logic
        // business logic
        //sigur in alta parte mai e inca o data:
        $d = CustomerHelper::getDiscountPercentage($customer);
        // business logic

        $this->insuranceService->requoteCustomer($customer);
    }

}