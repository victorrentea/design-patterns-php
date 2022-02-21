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


class UserService // DOMAIN LOGIC.
{
    private LdapUserAdapterInterface $ldapUserAdapter;

    public function __construct(LdapUserAdapterInterface $ldapUserAdapter)
    {
        $this->ldapUserAdapter = $ldapUserAdapter;
    }

    public function importUserFromLdap(string $username)
    {
        $user = $this->ldapUserAdapter->getUserByUsername($username);

        if ($user->getWorkEmail() !== null) {
            printf('Send welcome email to ' . $user->getWorkEmail() . "\n");
        }
        // biz rules BR-1231
        // biz rules BR-1231
        // biz rules BR-1231

        printf("Insert user in my database\n");
    }

}

