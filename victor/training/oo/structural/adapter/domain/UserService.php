<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 10:37 PM
 */

namespace victor\training\oo\structural\adapter\domain;



foreach (glob("../external/*.php") as $filename) require_once $filename;
include "User.php";
include "LdapUserServiceAdapter.php"; // SOLUTION



// DOMAIN SERVICE: Logica sfanta de domeniu
// vrei sa aperi codul asta de dusmanu, de exterior
class UserService // 100- 500 linii
{
    private ExternalUserServiceAdapter $adapter;

    public function __construct(ExternalUserServiceAdapter $adapter)
    {
        $this->adapter = $adapter;
    }


    public function importUserFromLdap(string $username)
    {
        $list = $this->adapter->findUserByUsername($username);
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
        return $this->adapter->findUserByUsername($username);
    }


    // deasupra liniei : cod frumos
    // -- o linie ------------------------------------------------------------------------------------
    // sub linie: gunoi. haos. jale.



}


$userService = new UserService(new LdapUserWebServiceClient()); // INITIAL

printf(implode(",",$userService->searchUserInLdap("jdoe")) . "\n");
$userService->importUserFromLdap('jdoe');