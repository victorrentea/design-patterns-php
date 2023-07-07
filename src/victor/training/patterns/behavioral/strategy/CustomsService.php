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
            case 'UK': $taxCalculator= new UKTaxCalculator(); break;
            case 'CN': $taxCalculator= new ChinaTaxCalculator(); break;
            case 'FR':
            case 'ES': // other EU country codes...
            case 'RO': $taxCalculator= new EUTaxCalculator(); break;
            default: throw new \RuntimeException("Not a valid country ISO2 code: {$originCountry}");
        }
        return $taxCalculator->compute($tobaccoValue, $otherValue);
    }
}
interface TaxCalculator {
    function compute(float $tobaccoValue, float $otherValue): float;
}


// Idee#2: sa dau value+tabaco pe constructor
// ori de cate ori poti evita sa tii date pe campuri (privaet...) si prefera in schimb
// daca le-ai pus pe atribute traiesc prea mult, si-ti dau emotii (mai ales daca nu sunt readonly),

// #Ideea#3: sa grupez cele 2 param intr-o clasa NOUA (HEAVY?) readonly Value Object aka ParameterObject
// panica tot acolo ramane
//readonly class TaxCalculationInput {
//    public function __construct(public ?float $otherValue = null, public  ?float $regularValue = null)
//    {
//    }
//}
//$t = new TaxCalculationInput();
//echo $t->otherValue;

class UKTaxCalculator implements TaxCalculator {
    public function compute(float $tobaccoValue, float $otherValue): float
    {
        // cod mult
        return $tobaccoValue / 2 + $otherValue / 2;
    }
}
class ChinaTaxCalculator implements TaxCalculator {
    public function compute(float $tobaccoValue, float $otherValue): float
    {
        // cod mult
        return $tobaccoValue + $otherValue;
    }
}
class EUTaxCalculator implements TaxCalculator {
    public function compute(float $tobaccoValue, float $otherValue_DEGEABA): float
    {
        // cod mult > 20 linii
        return $tobaccoValue / 3;
    }
}


$customsService = new CustomsService();
printf('Tax for (RO,100,100) = ' . $customsService->computeAddedCustomsTax("RO", 100, 100) . "\n");
printf('Tax for (CN,100,100) = ' . $customsService->computeAddedCustomsTax("CN", 100, 100) . "\n");
printf('Tax for (UK,100,100) = ' . $customsService->computeAddedCustomsTax("UK", 100, 100) . "\n");
