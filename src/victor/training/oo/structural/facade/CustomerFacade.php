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
use victor\training\oo\structural\service\CustomerService;

// class CustomerMapper {
//     static function toDto(Customer $customer): CustomerDto
//     {
//         $dto = new CustomerDto();
//         $dto->setName($customer->getName());
//         $dto->setEmail($customer->getEmail());
//         $dto->setAddress($customer->getAddress());
//         return $dto;
//     }
// }

// fiecare metoda publica din aceasta clasa e chemata direct din controller.
class CustomerFacade // ApplicationService
{
    private CustomerRepository $customerRepository;
    private NotificationService $notificationService;
    private CustomerService $customerService;

    public function __construct(CustomerRepository $customerRepository, NotificationService $notificationService, CustomerService $customerService)
    {
        $this->customerRepository = $customerRepository;
        $this->notificationService = $notificationService;
        $this->customerService = $customerService;
    }

    /** @return CustomerSearchResult[] */
    function search(CustomerSearchCriteria $searchCriteria): array
    {
        return $this->customerRepository->search($searchCriteria); // if am namePart atunci sql += " AND c.name LIKE '%' ?  ,
    }

    function getCustomerById(int $customerId): CustomerDto
    {
        $customer = $this->customerRepository->findById($customerId);
        // 1 conversie ad hoc
        // $dto = new CustomerDto();
        // $dto->setName($customer->getName());
        // $dto->setEmail($customer->getEmail());
        // $dto->setAddress($customer->getAddress());

        // 2 cu mapper (cu fc de instanta sau statica)
        // return CustomerMapper::toDto($customer);

        // 3  NICIODATA: cuplezi ce-ai mai sfant (entitati de domeniu) de gunoai de API (DTO)
        // return $customer->toDto();

        // 4 da: ok, pt ca cuplezi mizeria la cele sfinte. E ok. ! merge doar daca scrii Dto-urile tale DE MANA.
        return new CustomerDto($customer);
    }


    function registerCustomer(CustomerDto $customerDto)
    {
        $customer = $customerDto->toEntity();

        $this->customerService->registerCustomer($customer);

        $this->notificationService->sendWelcomeEmail($customer->getEmail());
    }
}

