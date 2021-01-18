<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 9:24 PM
 */

namespace training\oo\creational\builder;
use PHPUnit\Framework\TestCase;

include "Customer.php";
include "Address.php";
include "CustomerValidator.php";

class CustomerValidatorTest extends TestCase
{
    /* @var CustomerValidator*/
    private $validator;

    protected function setUp():void
    {
        $this->validator = new CustomerValidator();
    }

    public function testAValidCustomer_OK() {
        $customer = $this->aValidCustomer();
        $this->validator->validate($customer);
        self::assertTrue(true);
    }

    public function testThrowsForCustomerWithEmptyName() {
        $this->expectException(\Exception::class);
        $customer = $this->aValidCustomer()->setName("");
        $this->validator->validate($customer);
        self::assertTrue(true);
    }

    public function testThrowsForCustomerWithEmptyAddressCity() {
        $this->expectException(\Exception::class);
        $customer = $this->aValidCustomer()
            ->setAddress($this->aValidAddress()->setCity(""));
        $this->validator->validate($customer);
        self::assertTrue(true);
    }

    private function aValidCustomer(): Customer
    {
        return (new Customer())
            ->setName("John Doe")
            ->setPhone("0000000000")
            ->setAddress($this->aValidAddress());
    }

    private function aValidAddress(): Address
    {
        return (new Address())
            ->setCity("Bucharest");
    }

}