<?php


namespace victor\training\oo\behavioral\observer;


class Observer
{

}



class Baba {
    /** @var Barfitor[] */
    private array $abonati = [];

    function addBarfitor(Barfitor $barfitor)
    {
        $this->abonati[] = $barfitor;
    }

    function vedeCevaIntersant(string $noutate) {
        foreach ($this->abonati as $barfitor) {
            $barfitor->aflaBarfa($noutate);
        }
    }
}

interface Barfitor {
    function aflaBarfa(string $barfa): void;
}


//// --- pana aici e cod de "framewokr"
///

class CostacheDeLa5 implements Barfitor
{

    function aflaBarfa(string $barfa): void
    {
        echo "Aflu barfa $barfa\n" .
            "";
    }
}

class AgentSRI implements Barfitor
{

    function aflaBarfa(string $barfa): void
    {
        echo "Raportez $barfa\n";
    }
}


$baba = new Baba();
$baba->addBarfitor(new CostacheDeLa5());
$baba->addBarfitor(new AgentSRI());

$baba->vedeCevaIntersant("Rita a venit cu un pletos!!!");