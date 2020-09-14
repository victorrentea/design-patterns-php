<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 11:54 PM
 */

namespace victor\training\oo\behavioral\strategy;

class CustomsService
{

    public function computeAddedCustomsTax(string $originCountry, float $tobaccoValue, float $otherValue): float { // UGLY API we CANNOT change
        switch ($originCountry) {
            case 'UK': return $this->computeUKTax($tobaccoValue, $otherValue);
            case 'CH': return $this->computeChinaTax($tobaccoValue, $otherValue);
            case 'FR':
            case 'ES': // other EU country codes...
            case 'RO': return $this->computeEUTax($tobaccoValue);
            default: throw new \RuntimeException("JDD: Not a valid country ISO2 code: {$originCountry}");
        }
    }

    private function computeUKTax(float $tobaccoValue, float $otherValue): float
    {
        // 5-10 linii
        return $tobaccoValue / 2 + $otherValue / 2;
    }

    private function computeChinaTax(float $tobaccoValue, float $otherValue): float
    {
        return $tobaccoValue + $otherValue;
    }

    private function computeEUTax(float $tobaccoValue): float
    {
        return $tobaccoValue / 3;
    }

}


$customsService = new CustomsService();
printf('Tax for (RO,100,100) = ' . $customsService->computeAddedCustomsTax("RO", 100, 100) . '\n');
printf('Tax for (CH,100,100) = ' . $customsService->computeAddedCustomsTax("CH", 100, 100) . '\n');
printf('Tax for (UK,100,100) = ' . $customsService->computeAddedCustomsTax("UK", 100, 100) . '\n');


$th = 0.1/3;
$th /= 7;
//printf('Tax for (UK,100,100) = ' . );

$sum = 0;
for ($i = 0; $i < 10000; $i++) {
    $sum += 0.1;
}
var_dump($sum);



