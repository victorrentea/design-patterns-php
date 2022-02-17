<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 11:10 PM
 */

namespace victor\training\oo\structural\decorator;

include "ExpensiveMath.php";

 function logica(int $n, ExpensiveMathInterface $math) {

        $isPrime = $math->isPrime($n);
    printf("isPrime(" . $n . "): " . ($isPrime ? "Yes" : "No")."\n");
    if ($isPrime) {
        printf("next prime after ".$n.": " . $math->getNextPrimeAfter($n + 1)."\n");
    }

}
$math = new ExpensiveMath();
// $math = new CacheDecorator(new ExpensiveMath());

printf("Start... \n");

logica(179426549, $math);

logica(179426549, $math);
