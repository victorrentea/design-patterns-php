<?php

namespace victor\training\oo\structural\adapter\domain;

interface ExternalUserServiceAdapter
{
    /**
     * @return User[]
     */
    public function findUserByUsername(string $username): array;
}