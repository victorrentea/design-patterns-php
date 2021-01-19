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



// DOMAIN SERVICE: Logica sfanta de domeniu
// vrei sa aperi codul asta de dusmanu, de exterior
class UserService // 100- 500 linii
{
    private LdapUserWebServiceClient $wsClient;

    public function __construct(LdapUserWebServiceClient $wsClient)
    {
        $this->wsClient = $wsClient;
    }

    public function importUserFromLdap(string $username)
    {
        $list = $this->findUserInLdapByUsername($username);
        if (count($list) !== 1)
        {
            throw new \Exception('There is no single user matching username ' . $username);
        }

        $ldapUser = $list[0];
        $user = $this->convertUser($ldapUser);

        if ($user->getWorkEmail() !== null) {
            printf('Send welcome email to ' . $user->getWorkEmail() . "\n");
        }
        printf("Insert user in my database\n");
    }

    public function searchUserInLdap(string $username) {
        $list = $this->wsClient->search(strtoupper($username), null, null);
        $results = array();
        foreach ($list as $ldapUser) {
            $results[] = $this->convertUser($ldapUser);
        }
        return $results;
    }


    /**
     * @return LdapUser[]
     */
    private function findUserInLdapByUsername(string $username): array
    {
        return $this->wsClient->search(strtoupper($username), null, null);
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

$userService = new UserService(new LdapUserWebServiceClient()); // INITIAL

printf(implode(",",$userService->searchUserInLdap("jdoe")) . "\n");
$userService->importUserFromLdap('jdoe');