<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 12:44 PM
 */

namespace victor\training\oo\structural\facade;


use victor\training\oo\structural\service\RegisterCustomerService;

class CustomerFacade // aka ApplicationService (DDD)
{
    private CustomerRepository $customerRepository;
    private CustomerService $customerService;
    private OrderService $orderService;
    private EmailNotificationService $emailNotificationService;
    private RegisterCustomerService $registerCustomerService;



    public function searchCustomer(CustomerSearchCriteriaDto $searchCriteria) {
        $this->customerRepository->search($searchCriteria);
    }
    public function getCustomerById(int $customerId):CustomerDto {
        $this->customerRepository->findById($searchCriteria);
        return $dto;
    }

    public function registerCustomer(CustomerDto $customerDto)
    {
        $customer = $customerDto->toEntity();

        $this->registerCustomerService->registerCustomer($customer);
        $this->emailNotificationService->sendEmail($customer);
    }
}
class CustomerSearchCriteriaDto {
    // mireasma de JSON ><> direct din forma

    private string $namePart;
}

class CustomerController {

    private CustomerFacade  $customerFacade;


    function register(CustomerDto $customerDto) {
        $this->customerFacade->registerCustomer($customerDto);
    }
}

class CustomerDto{
    private string $name;
    private string $phone;
    private string $address;

    function toEntity():Customer {
        $entity = new Customer();
        $entity->setName($this->name);
        $entity->setPhone($this->phone);
        $entity->setAddress($this->address);
        return $entity;
    }
}

