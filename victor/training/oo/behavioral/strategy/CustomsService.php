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
    public function computeAddedCustomsTax(string $originCountry, float $tobaccoValue, float $otherValue): float
    { // UGLY API we CANNOT change
        return $this->selectTaxCalculator($originCountry)->calculate($tobaccoValue, $otherValue);
    }

    function selectTaxCalculator(string $countryCode): TaxCalculator
    {
        /** @var TaxCalculator[] $CALCULATORS */
        $CALCULATORS = [
            new UKCustomsTaxCalculator(), new ChinaCustomsTaxCalculator(), new EUCustomsTaxCalculator(),
            // new DefaultTaxCalculator() {can true}
        ];

        foreach ($CALCULATORS as $calculator) {
            if ($calculator->canCalculate($countryCode)) {
                return $calculator;
            }
        }
        throw new \RuntimeException("Not a valid country ISO2 code: {$countryCode}");

        // php8
        // return match ($countryCode)  {
        //     'UK'=>  new UKCustomsTaxCalculator(),
        //     'CN'=>  new ChinaCustomsTaxCalculator(),
        //     'FR', 'ES', 'RO'=>  new EUCustomsTaxCalculator()
        // };
    }
}



// yaml file : - UK: UKCustomsTaxCalculator

interface TaxCalculator{
    function canCalculate(string $countryCode):bool;
    function calculate(float $tobaccoValue, float $otherValue): float;
}

class ChinaCustomsTaxCalculator implements TaxCalculator{
    public function calculate(float $tobaccoValue, float $otherValue): float
    {
        return $tobaccoValue + $otherValue;
    }

    function canCalculate(string $countryCode): bool
    {
        return "CN" === $countryCode;
    }
}
// class MyRequest {
//     private ?string $a;
//     private ?string $b;
//     private ?string $c;
//     private ?string $d;
// }

class EUCustomsTaxCalculator implements TaxCalculator{
    public function calculate(float $tobaccoValue, float $otherValueDegeaba): float // bila neagra
    {
        return $tobaccoValue / 3;
    }

    function canCalculate(string $countryCode): bool
    {
        return in_array($countryCode, ['RO','ES','FR']);
    }
}
class UKCustomsTaxCalculator implements TaxCalculator{
    public function calculate(float $tobaccoValue, float $otherValue): float
    {
        echo "Las #sieu un pic de logica aici 3-5-10 liniii, ca e loc.";
        return $tobaccoValue / 2 + $otherValue / 2;
    }

    function canCalculate(string $countryCode): bool
    {
        return $countryCode == "UK";
    }
}


// schimbare de procesare la runtime. in fc de param de request.


$customsService = new CustomsService();
printf('Tax for (RO,100,100) = ' . $customsService->computeAddedCustomsTax("RO", 100, 100) . '\n');
printf('Tax for (CN,100,100) = ' . $customsService->computeAddedCustomsTax("CN", 100, 100) . '\n');
printf('Tax for (UK,100,100) = ' . $customsService->computeAddedCustomsTax("UK", 100, 100) . '\n');
