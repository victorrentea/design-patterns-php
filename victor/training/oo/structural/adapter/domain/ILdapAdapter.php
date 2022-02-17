<?php

namespace victor\training\oo\structural\adapter\domain;

interface ILdapAdapter
{
    function findOneByUsername(string $username): User;
}