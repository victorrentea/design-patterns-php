<?php

namespace victor\training\oo\structural\decorator;

interface IExpensiveMath
{
    function isPrime(int $number): bool;

    function getNextPrimeAfter(int $number): int;
}