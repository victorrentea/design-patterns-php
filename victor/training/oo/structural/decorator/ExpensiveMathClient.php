<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 11:10 PM
 */

namespace victor\training\oo\structural\decorator;

include "ExpensiveMath.php";

function testItAndIfPrimeGetNextOne(int $n, ExpensiveMath $math)
{

    $isPrime = $math->isPrime($n);
    printf("isPrime(" . $n . "): " . ($isPrime ? "Yes" : "No") . "\n");
    if ($isPrime) {
        printf("next prime after " . $n . ": " . $math->getNextPrimeAfter($n + 1) . "\n");
    }

}

$math = new ExpensiveMath();
printf("Start... \n");
testItAndIfPrimeGetNextOne(179426549*179426549, $math);

$t0 = microtime(true);
testItAndIfPrimeGetNextOne(179426549*179426549, $math);

$t1 = microtime(true);

echo 'Took' . ($t1-$t0);
