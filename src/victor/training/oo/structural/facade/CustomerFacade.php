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
use victor\training\oo\structural\service\RegisterCustomerService;

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
    private RegisterCustomerService $registerCustomerService;

    public function __construct(CustomerRepository $customerRepository, NotificationService $notificationService, RegisterCustomerService $customerService)
    {
        $this->customerRepository = $customerRepository;
        $this->notificationService = $notificationService;
        $this->registerCustomerService = $customerService;
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

        $this->registerCustomerService->registerCustomer($customer);

        $this->notificationService->sendWelcomeEmail($customer->getEmail());
    }
}


//
// class OrderFacade {
//
//     private OrderService $orderService;
//     private PlaceOrderService $placeOrderService;
//
//     function placeOrder()
//     {
//         $order = new COrder();
//         $this->orderService->functieVeche(new CeAmNevoiePeBune($order));
//     }
// }
// class CeAmNevoiePeBune {
//     private COrder $COrder;
//     // functii necesare lui PlaceOrderService
// }
//
// class OrderService  {
//     private PlaceOrderService $placeOrderService;
//
//     // monstru
//     //Order
//     public function functieVeche()
//     {
//         $this->placeOrderService->fctieNoua();
//     }
// }
//
// class PlaceOrderService {
//
//     public function fctieNoua()
//     {
//
//     }
// }
//
// class CLicense {
//
// }
// class CCustomer implements CCustomerForOrderInterface{
//
//     public function logic()
//     {
//
//     }
// }
// class CustomerService {
//
// }
//
// class COrder
// { // in code
//     //
//     private int $id;
//
//      // atribute din baza
//     function renewLicense()
//     {
//         // logica de biz
//         (new CCustomer($this->id))
//             ->logic();
//     }
//
// }
//
// // pas intermediar: logica din renewLicense --> RenewLicenseService (Domain) ,
// // dar ce era pe CCustomer am lasat acolo, dar am folosit printr-un Adapter.
//
// //