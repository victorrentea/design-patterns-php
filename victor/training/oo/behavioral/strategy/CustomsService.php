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
            case 'UK': $computer = new BrexitTaxComputer();break;
            case 'CH': $computer = new ChinaTaxComputer();break;
            case 'FR':
            case 'ES': // other EU country codes...
            case 'RO': $computer = new EUTaxComputer();break;
            default: throw new \RuntimeException("Not a valid country ISO2 code: {$originCountry}");
        }

        return $computer->compute($tobaccoValue, $otherValue);
    }
}
interface TaxComputerInterface {
    function compute(float $tobaccoValue, float $otherValue): float;
}

class EUTaxComputer implements TaxComputerInterface  {
    public function compute(float $tobaccoValue, float $otherValueDEGEABA): float
    {
        return $tobaccoValue / 3;
    }
}
class ChinaTaxComputer implements TaxComputerInterface  {
    public function compute(float $tobaccoValue, float $otherValue): float
    {
        return $tobaccoValue + $otherValue;
    }
}
class BrexitTaxComputer implements TaxComputerInterface  {
    public function compute(float $tobaccoValue, float $otherValue): float
    {
        echo "Logica lu marcel";
        echo "Logica lu marcel";
        echo "Logica lu Maria";
        return $tobaccoValue / 2 + $otherValue / 2;
    }
}


$customsService = new CustomsService();
printf('Tax for (RO,100,100) = ' . $customsService->computeAddedCustomsTax("RO", 100, 100) . '\n');
printf('Tax for (CH,100,100) = ' . $customsService->computeAddedCustomsTax("CH", 100, 100) . '\n');
printf('Tax for (UK,100,100) = ' . $customsService->computeAddedCustomsTax("UK", 100, 100) . '\n');
