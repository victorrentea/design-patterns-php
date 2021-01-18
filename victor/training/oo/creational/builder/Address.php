<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 1:36 AM
 */

namespace training\oo\creational\builder;


class Address
{
    /* @var String */
    private $streetName;

    /* @var Integer */
    private $streetNumber;

    /* @var String */
    private $city;

    /* @var String */
    private $country;

    /**
     * @return String
     */
    public function getStreetName(): string
    {
        return $this->streetName;
    }

    /**
     * @param String $streetName
     * @return Address
     */
    public function setStreetName(string $streetName): Address
    {
        $this->streetName = $streetName;
        return $this;
    }

    /**
     * @return int
     */
    public function getStreetNumber(): int
    {
        return $this->streetNumber;
    }

    /**
     * @param int $streetNumber
     * @return Address
     */
    public function setStreetNumber(int $streetNumber): Address
    {
        $this->streetNumber = $streetNumber;
        return $this;
    }

    /**
     * @return String
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param String $city
     * @return Address
     */
    public function setCity(string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return String
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param String $country
     * @return Address
     */
    public function setCountry(string $country): Address
    {
        $this->country = $country;
        return $this;
    }




}