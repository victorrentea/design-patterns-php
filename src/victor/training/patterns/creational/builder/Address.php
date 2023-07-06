<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 1:36 AM
 */

namespace victor\training\patterns\creational\builder;


class Address
{
    private string $streetName;

    private int $streetNumber;

    private string $city;

    private string $country;

    public function getStreetName(): String
    {
        return $this->streetName;
    }

    public function setStreetName(String $streetName): void
    {
        $this->streetName = $streetName;
    }

    public function getStreetNumber(): int
    {
        return $this->streetNumber;
    }

    public function setStreetNumber(int $streetNumber): void
    {
        $this->streetNumber = $streetNumber;
    }

    public function getCity(): String
    {
        return $this->city;
    }

    public function setCity(String $city): void
    {
        $this->city = $city;
    }

    public function getCountry(): String
    {
        return $this->country;
    }

    public function setCountry(String $country): void
    {
        $this->country = $country;
    }



}