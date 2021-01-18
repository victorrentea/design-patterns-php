<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/17/2017
 * Time: 7:51 PM
 */

namespace victor\training\oo\behavioral\singleton;
include('AppConfiguration.php');


class CodDeBiz
{
    private AppConfiguration $appConfig;

    public function __construct(AppConfiguration $appConfig)
    {
        $this->appConfig = $appConfig;
    }

    function m()
    {
        if ($this->appConfig->getProperty('a') === '') {
            throw new \Exception();
        }
    }
}

printf('Configuration setting a = ' . (AppConfiguration::getInstance())->getProperty('a') . "\n");
printf('Configuration setting b = ' . (AppConfiguration::getInstance())->getProperty('b'). "\n");
printf('Configuration setting a = ' . (AppConfiguration::getInstance())->getProperty('a') . "\n");