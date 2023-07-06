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
use victor\training\architecture\domain\service\RegisterCustomerService;
use victor\training\architecture\domain\service\InsuranceService;

class CustomerApplicationService
{
    private CustomerRepo $customerRepository;
    private InsuranceService $insuranceService;
    private RegisterCustomerService $customerDomainService;

    public function __construct(CustomerRepo $customerRepository, \victor\training\architecture\domain\service\InsuranceService $insuranceService, RegisterCustomerService $customerDomainService)
    {
        $this->customerRepository = $customerRepository;
        $this->insuranceService = $insuranceService;
        $this->customerDomainService = $customerDomainService;
    }

    /** @return CustomerSearchResult[] */
    function search(CustomerSearchCriteria $searchCriteria): array
    {
        return $this->customerRepository->search($searchCriteria);
    }

    function getCustomerById(int $customerId): CustomerDto
    {
        $customer = $this->customerRepository->findById($customerId);
//        $dto = $this->transformer->toDto($customer);// #1 Transformer / Factory cu cod simplu nu logica grea
//        $dto = $customer->toDto(); // #2 conversia in #[Entity] method -> REJECT LA PR: cuplezi ce-ai mai sfant (Entity) la API Model
        $dto = new CustomerDto($customer); // #3 conversia in ctor de DTO
            // + stergi 90% din transformeri
            // - nu poti pune DTO in composer packages. ok doar daca le dai swaggere la clienti
        return $dto;
    }


    function registerCustomer(CustomerDto $customerDto): CustomerDto
    {
        $customer = new Customer($customerDto->getName(), $customerDto->getEmail());
        $customer->setAddress($customerDto->getAddress());
        $this->customerDomainService->registerCustomerDomain($customer);

        // ---- pana aici scot intr-un Domain Service
        $this->insuranceService->requoteCustomer($customer);

        return $customerDto;
    }
}