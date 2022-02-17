<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 10:37 PM
 */

namespace victor\training\oo\structural\adapter\domain;


use victor\training\oo\structural\adapter\external\LdapUserDto;
use victor\training\oo\structural\adapter\external\LdapUserWebServiceClient;

foreach (glob("../external/*.php") as $filename) require_once $filename;
include "User.php";
include "LdapUserWSAdapter.php"; // SOLUTION

//Aici e pacea, armonia si ZENul. ying si yang. gradina imparatului.
// DOMAIN LOGICa ta centrala este implementata in Domain Serviceuri > devine un obiectiv esential sa tii
// cat mai curat mediul acestui Service
class UserService
{
    private LdapUserWebServiceClient $wsClient;

    public function __construct(LdapUserWebServiceClient $wsClient)
    {
        $this->wsClient = $wsClient;
    }

    public function importUserFromLdap(string $username)
    {
        $user = $this->findOneByUsername($username);

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

    /// raiul : domain
    ///////////// LINIE IMPORTANTA !
    /// iadul : infrastructura

    private function findOneByUsername(string $username): User
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

$userService = new UserService(new LdapUserWebServiceClient()); // INITIAL

$userService->importUserFromLdap('jdoe');