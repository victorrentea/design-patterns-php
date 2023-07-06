<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 10:30 PM
 */

namespace victor\training\architecture\infra\onrc;


class ONRC_SampleData
{
    /* @return ONRCLegalEntity[] */
    public static function getData() {
        $ldapUser1 = (new ONRCLegalEntity())
            ->setShortName("John")
            ->setExtendedFullName("DOE")
            ->setOnrcId("jdoe")
            ->setRegistrationDate(new \DateTime())
            ->setMainEml("0123456789")
            ->setEmailAddresses(array(new ONRCLegalEntityContactEmail("WORK", ONRCLegalEntityContactEmailType::OFFICE)));
        $ldapUser2 = (new ONRCLegalEntity())
            ->setShortName("Jane")
            ->setExtendedFullName("DOE")
            ->setOnrcId("janedoe")
            ->setRegistrationDate(new \DateTime());
//        return array($ldapUser1, $ldapUser2);
        return array($ldapUser1);
    }
}