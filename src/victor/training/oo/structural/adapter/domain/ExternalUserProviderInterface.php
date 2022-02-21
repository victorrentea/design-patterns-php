<?php

namespace victor\training\oo\structural\adapter\domain;

interface ExternalUserProviderInterface
{
    public function getByUsername(string $username): User;
}