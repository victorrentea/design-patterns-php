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
    private $primes = [];


    function getNextPrimeAfter(int $number): int {
        $n = $number;
        while(!$this->isPrime($n)) {
            $n ++;
        }
        return $n;
    }


//    function isPrime(int $number): bool {
//
//    }
    function isPrime(int $number): bool {
        if (isset($this->primes[$number])) {
            return $this->primes[$number];
        }
        if ($number  <= 2) {
            $this->primes[$number] = true;
            return true;
        }
        if ($number % 2 === 0) {
            $this->primes[$number] = false;
            return false;
        }
        for ($d = 3; $d < $number/2; $d += 2) {
            if ($number % $d === 0) {
                $this->primes[$number] = false;
                return false;
            }
        }
        $this->primes[$number] = true;
		return true;
    }
}