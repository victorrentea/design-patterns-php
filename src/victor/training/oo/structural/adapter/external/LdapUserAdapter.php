<?php

namespace victor\training\oo\structural\adapter\external;

use victor\training\oo\structural\adapter\domain\LdapUserAdapterInterface;
use victor\training\oo\structural\adapter\domain\User;

class LdapUserAdapter implements LdapUserAdapterInterface
{
    private LdapUserWebServiceClient $wsClient;

    public function __construct(LdapUserWebServiceClient $wsClient)
    {
        $this->wsClient = $wsClient;
    }

    public function getUserByUsername(string $username): User
    {
        $list = $this->wsClient->search(strtoupper($username), null, null);
        if (count($list) !== 1) {
            throw new \Exception('There is no single user matching username ' . $username);
        }

        $ldapUser = $list[0];
        $fullName = $ldapUser->getfName() . ' ' . strtoupper($ldapUser->getlName());
        return new User($ldapUser->getUId(), $fullName, $ldapUser->getWorkEmail());
    }

}