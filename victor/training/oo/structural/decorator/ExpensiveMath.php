<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 11:05 PM
 */

namespace victor\training\oo\structural\decorator;


class CacheDecorator implements  ExpensiveMathInterface{
    private ExpensiveMathInterface $delegate;

    private array $cache = [];

    public function __construct(ExpensiveMathInterface $delegate)
    {
        $this->delegate = $delegate;
    }

    function getNextPrimeAfter(int $number): int {
        if (isset($this->cache[$number])) {
            return $this->cache[$number];
        }
        $result = $this->delegate->getNextPrimeAfter($number);
        $this->cache[$number]=$result;
        return $result;
    }

    private array $cache2 = [];
    function isPrime(int $number): bool
    {
        if (isset($this->cache2[$number])) {
            return $this->cache2[$number];
        }
        $result = $this->delegate->isPrime($number);
        $this->cache2[$number]=$result;
        return $result;
    }
}

interface ExpensiveMathInterface {
    function getNextPrimeAfter(int $number): int;
    function isPrime(int $number): bool;
}

    // NU AI VOIE SA EXTINZI CLASE CONCRETE DIN APP TA.
class ExpensiveMath implements ExpensiveMathInterface
{


    function getNextPrimeAfter(int $number): int
    {
        $n = $number;
        while (!$this->isPrime($n)) {
            $n++;
        }
        return $n;
    }


    function isPrime(int $number): bool
    {
        if ($number <= 2) {
            return true;
        }
        if ($number % 2 === 0) {
            return false;
        }
        for ($d = 3; $d < $number / 2; $d += 2) {
            if ($number % $d === 0) {
                return false;
            }
        }
        return true;
    }
}

