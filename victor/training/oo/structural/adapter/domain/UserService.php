<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 10:37 PM
 */

namespace victor\training\oo\structural\adapter\domain;


use victor\training\oo\structural\adapter\external\LdapUser;
use victor\training\oo\structural\adapter\external\LdapUserWebServiceClient;

foreach (glob("../external/*.php") as $filename) require_once $filename;
include "User.php";
//include "LdapUserWSAdapter.php"; // SOLUTION


// Asta e in gradina ta sacra (Domain module)
class UserService
{
    private LdapUserWebServiceClient $wsClient;

    public function __construct(LdapUserWebServiceClient $wsClient)
    {
        $this->wsClient = $wsClient;
    }

    public function importUserFromLdap(string $username)
    {
        $list = $this->searchByUsername($username);
        if (count($list) !== 1)
        {
            throw new \Exception('There is no single user matching username ' . $username);
        }

        $user = $list[0];

        if ($user->getWorkEmail() !== null) {
            printf('Send welcome email to ' . $user->getWorkEmail() . "\n");
        }
        printf("Insert user in my database\n");
    }

    public function searchUserInLdap(string $username) {
        return $this->searchByUsername($username);
    }

    /// -------------------------------- o linie ------------------------------


    /**
     * @param string $username
     * @return User[]
     */
    private function searchByUsername(string $username): array
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

$userService = new UserService(new LdapUserWebServiceClient()); // INITIAL

printf(implode(",",$userService->searchUserInLdap("jdoe")) . "\n");
$userService->importUserFromLdap('jdoe');