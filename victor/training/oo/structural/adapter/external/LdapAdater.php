<?php

namespace victor\training\oo\structural\adapter\external;

use victor\training\oo\structural\adapter\domain\ILdapAdapter;
use victor\training\oo\structural\adapter\domain\User;

class LdapAdater implements ILdapAdapter
{
    private LdapUserWebServiceClient $wsClient;

    public function __construct(LdapUserWebServiceClient $wsClient)
    {
        $this->wsClient = $wsClient;
    }

    public function findOneByUsername(string $username): User
    {
        $list = $this->wsClient->search(strtoupper($username), null, null);
        if (count($list) !== 1) {
            throw new \Exception('There is no single user matching username ' . $username);
        }
        return $this->fromDto($list[0]);
    }

    private function fromDto(LdapUserDto $ldapUser): User
    {

        $fullName = $ldapUser->getfName() . ' ' . strtoupper($ldapUser->getlName());
        return new User($ldapUser->getUId(), $fullName, $ldapUser->getWorkEmail());
    }


}