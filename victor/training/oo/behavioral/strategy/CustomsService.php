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
        /** @var TaxComputerInterface[] $computers */
        // $computers = [new ChinaTaxComputer(), new BrexitTaxComputer(), new EUTaxComputer()];
        //
        // foreach ($computers as $computer) {
        //     if ($computer->isApplicable($originCountry)) {
        //         return $computer->compute($tobaccoValue, $otherValue);
        //     }
        // }
        $computer = $this->taxCalculatorFactory($originCountry);


        return $computer->compute($tobaccoValue, $otherValue);
    }



    private $countryCalculator = [
        'UK' => BrexitTaxComputer::class,
        'CH' => ChinaTaxComputer::class,
        'RO' => EUTaxComputer::class,
        'ES' => EUTaxComputer::class,
        'FR' => EUTaxComputer::class
    ];


    private function taxCalculatorFactory(string $originCountry): TaxComputerInterface
    {
        // $this->container->getObject($this->countryCalculator[$originCountry]);
// TEaser: php8 :)
        return new $this->countryCalculator[$originCountry];
        //
        // $computer = match ($originCountry) {
        //     'UK' => new BrexitTaxComputer(),
        //     'CH' => new ChinaTaxComputer(),
        //     'FR', 'ES', 'RO' => new EUTaxComputer(),
        //     default => throw new \RuntimeException("Not a valid country ISO2 code: {$originCountry}"),
        // };
        // return $computer;
    }





}

// class TaxCalculatorFactory {
// }

interface TaxComputerInterface {
    function compute(float $tobaccoValue, float $otherValue): float;

    public function isApplicable(string $countryCode): bool;
}

class EUTaxComputer implements TaxComputerInterface  {

    public function isApplicable(string $countryCode): bool
    {
        return in_array($countryCode, ["FR", "RO", "ES"]);
    }
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

    public function isApplicable(string $countryCode): bool
    {
        return "CH" === $countryCode;
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

    public function isApplicable(string $countryCode): bool
    {
        return "UK" === $countryCode;
    }
}


$customsService = new CustomsService();
printf('Tax for (RO,100,100) = ' . $customsService->computeAddedCustomsTax("RO", 100, 100) . '\n');
printf('Tax for (CH,100,100) = ' . $customsService->computeAddedCustomsTax("CH", 100, 100) . '\n');
printf('Tax for (UK,100,100) = ' . $customsService->computeAddedCustomsTax("UK", 100, 100) . '\n');
printf('Tax for (UK,100,100) = ' . $customsService->computeAddedCustomsTax("TU", 100, 100) . '\n');
