<?php

namespace victor\training\oo\structural\decorator;

class ExpensiveMathCuCash implements IExpensiveMath
{
    private IExpensiveMath $delegate;

    private array $cache = [];

    public function __construct(IExpensiveMath $delegate)
    {
        $this->delegate = $delegate;
    }

    function isPrime(int $number): bool
    {
        if (array_key_exists($number, $this->cache)) {
            return $this->cache[$number];
        }
        $isPrime = $this->delegate->isPrime($number);
        $this->cache[$number] = $isPrime;
        return $isPrime;
    }

    function getNextPrimeAfter(int $number): int
    {
        return $this->delegate->getNextPrimeAfter($number);
    }
}