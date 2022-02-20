<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 10:25 PM
 */

namespace victor\training\oo\structural\adapter\external;


class LdapUser
{
    private string $fName;
    private string $lName;
    private \DateTime $creationDate;
    private string $uId;
    private ?string $workEmail;
    /* @var LdapUserPhone[] */
    private array $emailAddresses = array();

    public function getFName(): string
    {
        return $this->fName;
    }

    public function setFName(string $fName): LdapUser
    {
        $this->fName = $fName;
        return $this;
    }

    public function getLName(): string
    {
        return $this->lName;
    }

    public function setLName(string $lName): LdapUser
    {
        $this->lName = $lName;
        return $this;
    }

    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTime $creationDate): LdapUser
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    public function getUId(): string
    {
        return $this->uId;
    }

    public function setUId(string $uId): LdapUser
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
     * @return LdapUser
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
     * @return LdapUser
     */
    public function setEmailAddresses(array $emailAddresses): LdapUser
    {
        $this->emailAddresses = $emailAddresses;
        return $this;
    }


}