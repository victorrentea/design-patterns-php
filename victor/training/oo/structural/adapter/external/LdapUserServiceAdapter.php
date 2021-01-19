<?php

namespace victor\training\oo\structural\adapter\domain;

use victor\training\oo\structural\adapter\external\LdapUser;
use victor\training\oo\structural\adapter\external\LdapUserWebServiceClient;

class LdapUserServiceAdapter implements ExternalUserServiceAdapter
{
    private LdapUserWebServiceClient $wsClient;

    public function __construct(LdapUserWebServiceClient $wsClient)
    {
        $this->wsClient = $wsClient;
    }

    /**
     * @return User[]
     */
    public function findUserByUsername(string $username): array
    {
        $ldapUsers = $this->wsClient->search(strtoupper($username), null, null);
        $users = [];
        foreach ($ldapUsers as $ldapUser) {
            $users[] = $this->convertUser($ldapUser);
        }
        return $users;
    }

    private function convertUser(LdapUser $ldapUser): User
    {
        $fullName = $ldapUser->getfName() . ' ' . strtoupper($ldapUser->getlName());
        $user = new User();
        $user->setUsername($ldapUser->getUId());
        $user->setFullName($fullName);
        $user->setWorkEmail($ldapUser->getWorkEmail());
        return $user;
    }
}