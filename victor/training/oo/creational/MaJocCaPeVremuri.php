<?php

class XService {
    function utila() {
        //complexa, mama ei, are testele ei pe ea calare.
    }
}

class ClasaMea {
    private XService $service;

    public function __construct(XService $service)
    {
        $this->service = $service;
    }

    function logicaComplexa() {
        // eu
        // eu
        // eu
        // eu
        // eu
        // (new XService())->utila();
        // ServiceLocator::getBean(XService::class)->utila(); // super util acum 12-17 ani. azi = antipattern

        // A: new de fiecare data: 1:timp 2: memorie
        // B: greu de testat (nu poti strecura un mock)
    }
}

// PhpTest MOCKURI !!!!!!!

class ServiceLocator { // singleton
    function setMockFromTests(string $class, $mockObject) {

    }
    public static function getBean(string $class)
    {

    }
}

//////// Singleton Pattern  = sa nu iti permita sa creezi mai mult de o instanta
class Singleton { // pe stilu vechi ( programatic )
    static private Singleton $INSTANCE;
    private function __construct()
    {
    }
    public static function getInstance()
    {
        if (self::$INSTANCE == null) {
            self::$INSTANCE = new Singleton();
        }
        return self::$INSTANCE;
    }
    private function __clone()
    {
    }
    public function __wakeup()
    {
    }
}


$singleton = Singleton::getInstance();
$singleton = Singleton::getInstance();
$singleton = Singleton::getInstance();