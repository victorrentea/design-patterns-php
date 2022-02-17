<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 10:36 PM
 */

namespace victor\training\oo\structural\adapter\domain;


// parte din domeniu
class User
{
    private string $username;
    private string $fullName;
    private ?string $workEmail;

    public function __construct(string $username, string $fullName, ?string $workEmail)
    {
        if (strlen($username) < 2) {
            throw new \Exception();
        }
        $this->username = $username;
        $this->fullName = $fullName;
        $this->workEmail = $workEmail;
    }

    public function getUsername(): string
    {
        return $this->username;
    }


    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return mixed
     */
    public function getWorkEmail()
    {
        return $this->workEmail;
    }


    public function __toString()
    {
        return "User " . $this->username;
    }

    public function hasWorkEmail(): bool
    {
        return $this->workEmail !== null;
    }


}