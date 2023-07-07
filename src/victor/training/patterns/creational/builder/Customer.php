<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 1:31 AM
 */

namespace victor\training\patterns\creational\builder;


class Customer
{
    private string $name;

    private string $phone;

    /* @var String[] */
    private array $labels = array();

    private Address $address;

    private \DateTime $createDate;

    public function __construct()
    {
        $this->labels = [];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Customer
    {
        $this->name = $name;
        return $this;
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
        return $this;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): Customer
    {
        $this->address = $address;
        return $this;
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