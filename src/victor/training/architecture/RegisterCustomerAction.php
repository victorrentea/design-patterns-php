<?php

namespace victor\training\architecture;

use victor\training\architecture\application\dto\CustomerDto;
use victor\training\architecture\domain\model\Customer;
use victor\training\architecture\domain\model\CustomerHelper;
use victor\training\architecture\domain\service\InsuranceService;
class RegisterCustomerInputDto {
    private string $name;
    private string $email;
    private string $address;

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAddress(): string
    {
        return $this->address;
    }
}
class RegisterCustomerAction
{
    public function __construct(
        readonly private InsuranceService $insuranceService
    )
    {
    }
//    #[Route(
//        ....
//    )]
    function registerCustomer(RegisterCustomerInputDto $request): void
    {
        $customer = new Customer($request->getName(), $request->getEmail());
        $customer->setAddress($request->getAddress());
        $this->registerCustomerDomain($customer);

        // ---- pana aici scot intr-un Domain Service
        $this->insuranceService->requoteCustomer($customer);
    }
    private function registerCustomerDomain(Customer $customer): void
    {
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
        $this->customerRepository->save($customer);
    }
}