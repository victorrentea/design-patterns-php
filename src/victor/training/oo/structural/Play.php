<?php


use victor\training\oo\structural\adapter\domain\UserService;
use victor\training\oo\structural\adapter\external\LdapUserAdapter;
use victor\training\oo\structural\adapter\external\LdapUserWebServiceClient;

$userService = new UserService(new LdapUserAdapter(new LdapUserWebServiceClient())); // INITIAL

$userService->importUserFromLdap('jdoe');
