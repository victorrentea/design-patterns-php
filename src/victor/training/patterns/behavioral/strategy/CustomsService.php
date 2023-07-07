<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 11:54 PM
 */

namespace victor\training\patterns\behavioral\strategy;

class CustomsService
{

    public function computeAddedCustomsTax(string $originCountry,
                                           float $tobaccoValue,
                                           float $otherValue): float { // UGLY API we CANNOT change
        switch ($originCountry) {
            case 'UK': return $this->computeUKTax($tobaccoValue, $otherValue);
            case 'CN': return $this->computeChinaTax($tobaccoValue, $otherValue);
            case 'FR':
            case 'ES': // other EU country codes...
            case 'RO': return $this->computeEUTax($tobaccoValue);
            default: throw new \RuntimeException("Not a valid country ISO2 code: {$originCountry}");
        }
    }

    public function computeUKTax(float $tobaccoValue, float $otherValue): float
    {
        // chestii
        // logic
        // mai multalogic
        // mai multa logic
        // mai multa logic
        return $tobaccoValue / 2 + $otherValue / 2;
    }

    public function computeChinaTax(float $tobaccoValue, float $otherValue): float
    {
        return $tobaccoValue + $otherValue;
    }

    public function computeEUTax(float $tobaccoValue): float
    {
        return $tobaccoValue / 3;
    }

}


$customsService = new CustomsService();
printf('Tax for (RO,100,100) = ' . $customsService->computeAddedCustomsTax("RO", 100, 100) . "\n");
printf('Tax for (CN,100,100) = ' . $customsService->computeAddedCustomsTax("CN", 100, 100) . "\n");
printf('Tax for (UK,100,100) = ' . $customsService->computeAddedCustomsTax("UK", 100, 100) . "\n");
