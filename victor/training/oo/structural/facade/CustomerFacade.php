<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 12:44 PM
 */

namespace victor\training\oo\structural\facade;


use victor\training\oo\structural\facade\dto\CustomerDto;
use victor\training\oo\structural\facade\dto\CustomerSearchCriteria;
use victor\training\oo\structural\facade\dto\CustomerSearchResult;

class CustomerFacade
{
    private CustomerRepository $customerRepository;
    private NotificationService $notificationService;

    public function __construct(CustomerRepository $customerRepository, NotificationService $notificationService)
    {
        $this->customerRepository = $customerRepository;
        $this->notificationService = $notificationService;
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


    function registerCustomer(CustomerDto $customerDto)
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
        $discountPercentage = 3;
        if ($customer->isGenius()) {
            $discountPercentage = 4;
        }
        echo "Biz logic with $discountPercentage";
        // business logic
        // business logic
        // business logic

        $this->notificationService->sendWelcomeEmail($customer->getEmail());

    }

}