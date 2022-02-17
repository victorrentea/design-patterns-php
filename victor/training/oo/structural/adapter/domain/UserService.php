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
include "LdapUserWSAdapter.php"; // SOLUTION

//Aici e pacea, armonia si ZENul. ying si yang. gradina imparatului.
// DOMAIN LOGICa ta centrala este implementata in Domain Serviceuri > devine un obiectiv esential sa tii
// cat mai curat mediul acestui Service
class UserService
{
    private ILdapAdapter $adapter;

    public function __construct(ILdapAdapter $adapter)
    {
        $this->adapter = $adapter;
    }


    public function importUserFromLdap(string $username)
    {
        $user = $this->adapter->findOneByUsername($username);

        if ($user->hasWorkEmail()) {
            printf('Send welcome email to ' . $user->getWorkEmail() . "\n");
        }
        // logica de domeniu complicata
        // logica de domeniu complicata
        // logica de domeniu complicata
        // logica de domeniu complicata
        // logica de domeniu complicata
        printf("Insert user in my database\n");
    }

}

$userService = new UserService(new LdapUserWebServiceClient()); // INITIAL

$userService->importUserFromLdap('jdoe');