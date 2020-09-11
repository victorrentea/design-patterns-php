<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 11:05 PM
 */

namespace victor\training\oo\structural\decorator;

class ExpensiveMath
{
    function getNextPrimeAfter(int $number): int {
        $n = $number;
        while(!$this->isPrime($n)) {
            $n ++;
        }
        return $n;
    }

    private array $cache = [];

    function isPrime(int $number): bool
    {
        if (array_key_exists($number, $this->cache)) {
            return $this->cache[$number];
        }
        $isPrime = $this->isPrime_($number);
        $this->cache[$number] = $isPrime;
        return $isPrime;
    }
    private function isPrime_(int $number): bool {
        if ($number  <= 2) {
            return true;
        }
        if ($number % 2 === 0) {
            return false;
        }
        for ($d = 3; $d < $number/2; $d += 2) {
            if ($number % $d === 0) {
                return false;
            }
        }
		return true;
    }
}