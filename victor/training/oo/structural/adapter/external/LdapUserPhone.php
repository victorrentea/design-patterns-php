<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 10:29 PM
 */

namespace victor\training\oo\structural\adapter\external;


class LdapUserPhone
{
    private string $val;
    private string $type;

    public function __construct(string $val, string $type)
    {
        $this->val = $val;
        $this->type = $type;
    }

    public
    function getVal(): string
    {
        return $this->val;
    }

    public
    function getType(): string
    {
        return $this->type;
    }

}