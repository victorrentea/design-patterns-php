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

    // Switch vs Polymorphism
    public function computeAddedCustomsTax(string $originCountry, float $tobaccoValue, float $otherValue): float { // UGLY API we CANNOT change
        $computer = $this->selectTaxCompute($originCountry);
        return $computer->compute($tobaccoValue, $otherValue);
    }

    private function selectTaxCompute(string $originCountry): TaxComputer
    {
        $map = [ // astea pot fi citite dintr-un JSON/yaml
            "UK" => UKTaxComputer::class,
            "CH" => ChinaTaxComputer::class,
            "FR" => EUTaxComputer::class,
            "ES" => EUTaxComputer::class,
            "RO" => EUTaxComputer::class
        ];
        if (!array_key_exists($originCountry, $map)) {
            throw new \RuntimeException("JDD: Not a valid country ISO2 code: {$originCountry}");
        }
        return new $map[$originCountry]();
    }

}
interface TaxComputer {
    public function compute(float $tobaccoValue, float $otherValue): float;
}

class UKTaxComputer implements TaxComputer {
    public function compute(float $tobaccoValue, float $otherValue): float
    {
        // 50-100 linii
        return $tobaccoValue / 2 + $otherValue / 2;
    }
}
class ChinaTaxComputer implements TaxComputer {
    public function compute(float $tobaccoValue, float $otherValue): float
    {
        return $tobaccoValue + $otherValue;
    }
}
class EUTaxComputer implements TaxComputer {
    public function compute(float $tobaccoValue, float $otherValueDegeaba): float
        // am pierdut specificicitate incercand sa ma supun majoritatii.
    {
        return $tobaccoValue / 3;
    }
}





$customsService = new CustomsService();
printf('Tax for (RO,100,100) = ' . $customsService->computeAddedCustomsTax("RO", 100, 100) . "\n");
printf('Tax for (CH,100,100) = ' . $customsService->computeAddedCustomsTax("CH", 100, 100) . "\n");
printf('Tax for (UK,100,100) = ' . $customsService->computeAddedCustomsTax("UK", 100, 100) . "\n");


$th = 0.1/3;
$th /= 7;
//printf('Tax for (UK,100,100) = ' . );

$sum = 0;
for ($i = 0; $i < 10000; $i++) {
    $sum += 0.1;
}
var_dump($sum);



