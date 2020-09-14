<?php


namespace victor\training\oo\structural\adapter\external;


use victor\training\oo\structural\adapter\domain\ExternalUserService;
use victor\training\oo\structural\adapter\external\LdapUser;
use victor\training\oo\structural\adapter\external\LdapUserWebServiceClient;

class LdapUserAdapter implements ExternalUserService
{
    private LdapUserWebServiceClient $wsClient;

    public function __construct(LdapUserWebServiceClient $wsClient)
    {
        $this->wsClient = $wsClient;

    }


    /**
     * @param string $username
     * @return User[]
     */
    public function searchByUsername(string $username): array
    {
        $ldapUsers = $this->wsClient->search(strtoupper($username), null, null);
        $results = [];
        foreach ($ldapUsers as $ldapUser) {
            $results[] = $this->convert($ldapUser);
        }
        return $results;
    }

    private function composeFullName(LdapUser $ldapUser): string
    {
        return $ldapUser->getfName() . ' ' . strtoupper($ldapUser->getlName());
    }

    private function convert(LdapUser $ldapUser): User
    {
        $fullName = $this->composeFullName($ldapUser);
        $user = new User();
        $user->setUsername($ldapUser->getUId());
        $user->setFullName($fullName);
        $user->setWorkEmail($ldapUser->getWorkEmail());
        return $user;
    }
}