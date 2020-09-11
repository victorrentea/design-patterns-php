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
    private LdapUserAdapter $adapter;

    public function __construct(LdapUserAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function importUserFromLdap(string $username)
    {
        $list = $this->adapter->searchByUsername($username);
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
        return $this->adapter->searchByUsername($username);
    }



    /// -------------------------------- o linie ------------------------------


}

$userService = new UserService(new LdapUserWebServiceClient()); // INITIAL

printf(implode(",",$userService->searchUserInLdap("jdoe")) . "\n");
$userService->importUserFromLdap('jdoe');