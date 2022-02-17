<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 10:25 PM
 */

namespace victor\training\oo\structural\adapter\external;


class LdapUserDto
{
    /* @var string */
    private $fName;
    /* @var string */
    private $lName;
    /* @var \DateTime */
    private $creationDate;
    /* @var string */
    private $uId;
    /* @var ?string */
    private $workEmail;
    /* @var LdapUserPhone[] */
    private $emailAddresses = array();

    public function getFName(): string
    {
        return $this->fName;
    }

    public function setFName(string $fName): LdapUserDto
    {
        $this->fName = $fName;
        return $this;
    }

    public function getLName(): string
    {
        return $this->lName;
    }

    public function setLName(string $lName): LdapUserDto
    {
        $this->lName = $lName;
        return $this;
    }

    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTime $creationDate): LdapUserDto
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    public function getUId(): string
    {
        return $this->uId;
    }

    public function setUId(string $uId): LdapUserDto
    {
        $this->uId = $uId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWorkEmail()
    {
        return $this->workEmail;
    }

    /**
     * @param mixed $workEmail
     * @return LdapUserDto
     */
    public function setWorkEmail($workEmail)
    {
        $this->workEmail = $workEmail;
        return $this;
    }

    /**
     * @return LdapUserPhone[]
     */
    public function getEmailAddresses(): array
    {
        return $this->emailAddresses;
    }

    /**
     * @param LdapUserPhone[] $emailAddresses
     * @return LdapUserDto
     */
    public function setEmailAddresses(array $emailAddresses): LdapUserDto
    {
        $this->emailAddresses = $emailAddresses;
        return $this;
    }


}