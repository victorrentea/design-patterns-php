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
    /** @var TaxCalculator[] $taxCalculators */  // kung fu de Symphony injectez aici toate implem de taxCalculator
    public function __construct(private readonly array $taxCalculators)
    {
    }


    public function computeAddedCustomsTax(string $originCountry,
                                           float  $tobaccoValue,
                                           float  $otherValue): float
    {
        foreach ($this->taxCalculators as $taxCalculator) {
            if ($taxCalculator->accepts($originCountry)) {
               return  $taxCalculator->compute($tobaccoValue, $otherValue);
            }
        }
        // UGLY API we CANNOT change
//        $taxCalculator = match ($originCountry) { // genial arata
//            'UK' => new UKTaxCalculator(),
//            'CN' => new ChinaTaxCalculator(),
//            'FR', 'ES', 'RO' => new EUTaxCalculator(),
//            default => throw new \RuntimeException("Not a valid country ISO2 code: {$originCountry}"),
//        };
        throw new \Exception();
    }
}

class CountryContext
{
    private string $country;

    public function getCountry(): string
    {
        return $this->country;
    }
}

interface TaxCalculator
{
    function accepts(string $originCountry): bool;

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

class UKTaxCalculator implements TaxCalculator
{
    public function compute(float $tobaccoValue, float $otherValue): float
    {
        // cod mult
        return $tobaccoValue / 2 + $otherValue / 2;
    }

    function accepts(string $originCountry): bool
    {
        return $originCountry === "UK";
    }
}

class ChinaTaxCalculator implements TaxCalculator
{
    public function compute(float $tobaccoValue, float $otherValue): float
    {
        // cod mult
        return $tobaccoValue + $otherValue;
    }

    function accepts(string $originCountry): bool
    {
        return $originCountry === "CN";
    }
}

class EUTaxCalculator implements TaxCalculator
{
    public function compute(float $tobaccoValue, float $otherValue_DEGEABA): float
    {
        // cod mult > 20 linii
        return $tobaccoValue / 3;
    }

    function accepts(string $originCountry): bool
    {
        return in_array($originCountry, ["RO", "ES", "FR"]);
    }
}

class DefaultCalculator implements TaxCalculator
{
    public function compute(float $tobaccoValue, float $otherValue_DEGEABA): float
    {
        return 10;
    }

    function accepts(string $originCountry): bool
    {
        return true;
    }
}


$customsService = new CustomsService([new ChinaTaxCalculator(), new EUTaxCalculator(), new UKTaxCalculator(),/*risk*/ new DefaultCalculator()]);
printf('Tax for (RO,100,100) = ' . $customsService->computeAddedCustomsTax("RO", 100, 100) . "\n");
printf('Tax for (CN,100,100) = ' . $customsService->computeAddedCustomsTax("CN", 100, 100) . "\n");
printf('Tax for (UK,100,100) = ' . $customsService->computeAddedCustomsTax("UK", 100, 100) . "\n");
