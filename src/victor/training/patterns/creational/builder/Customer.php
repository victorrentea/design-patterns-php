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

    public function getName(): String
    {
        return $this->name;
    }

    public function setName(String $name): void
    {
        $this->name = $name;
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
    public function setLabels(array $labels): void
    {
        $this->labels = $labels;
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