<?php

namespace victor\training\oo\structural\adapter\domain;

interface ExternalUserService
{
    /**
     * @return User[]
     */
    public function searchByUsername(string $username): array;
}