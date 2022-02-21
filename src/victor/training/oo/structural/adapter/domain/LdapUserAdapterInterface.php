<?php

namespace victor\training\oo\structural\adapter\domain;

interface LdapUserAdapterInterface
{
    public function getUserByUsername(string $username): User;
}