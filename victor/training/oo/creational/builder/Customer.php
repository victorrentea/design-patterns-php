<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 1:31 AM
 */

namespace training\oo\creational\builder;
//
// class Builder { // ,mai degrama mapper, converter, transfomer, unmarshaller
//     function build(array $flatAsocArray) {
//         return new self(new Address())->setAstat(flatAsocArray['key1'])
//     }
// }

class Customer
{
    private string $name;
    private string $phone;
    /* @var String[] */
    private array $labels = array();
    private Address $address;
    private \DateTime $createDate;

    // static function create() {
    //     new Customer(a,a,);
    // }
    public function __construct(string $name, string $phone,
                                array $labels, Address $address,
                                \DateTime $createDate)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->labels = $labels;
        $this->address = $address;
        $this->createDate = $createDate;
    }


    public function getName(): String
    {
        return $this->name;
    }

    public function setName(String $name): Customer
    {
        $this->name = $name;
        return $this;
    }

    public function getPhone(): String
    {
        return $this->phone;
    }

    public function setPhone(String $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return String[]
     */
    public function getLabels(): array
    {
        return $this->labels;
    }

    /**
     * @param String[] $labels
     */
    public function setLabels(array $labels): Customer
    {
        $this->labels = $labels;
        return this;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    public function getCreateDate(): \DateTime
    {
        return $this->createDate;
    }

    public function setCreateDate(\DateTime $createDate): void
    {
        $this->createDate = $createDate;
    }

}