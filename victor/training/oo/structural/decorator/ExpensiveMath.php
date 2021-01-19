<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 11:05 PM
 */

namespace victor\training\oo\structural\decorator;


class ExpensiveMathCuCache
{
    private ExpensiveMath $delegate;
    private $primes = [];

    public function __construct(ExpensiveMath $delegate)
    {
        $this->delegate = $delegate;
    }

    function isPrime(int $number): bool
    {
        if (isset($this->primes[$number])) {
            return $this->primes[$number];
        }
        $result = $this->delegate->isPrime($number);
        $this->primes[$number] = $result;
        return $result;
    }

    function getNextPrimeAfter(int $number): int
    {
        return $this->delegate->getNextPrimeAfter($number);
    }
}
class ExpensiveMath
{

    function getNextPrimeAfter(int $number): int {
        $n = $number;
        while(!$this->isPrime($n)) {
            $n ++;
        }
        return $n;
    }


    function isPrime(int $number): bool {
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