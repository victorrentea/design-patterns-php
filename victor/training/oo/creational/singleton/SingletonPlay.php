<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/17/2017
 * Time: 7:51 PM
 */

namespace victor\training\oo\behavioral\singleton;
include('AppConfiguration.php');



// de prod
printf('Configuration setting a = ' . (AppConfiguration::getInstance())->getProperty('a') . "\n");


//teste
Tu ai vrea ca getPropery('a')  sa intoarca "X"

class AppConfigForTest extends AppConfiguration {
    public function getProperty(string $propertyName): string
    {
        return "X";
    }
}

AppConfiguration::setINSTANCEForTests(new AppConfigForTest());