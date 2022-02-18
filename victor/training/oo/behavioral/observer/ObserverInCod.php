<?php

namespace victor\training\oo\behavioral\observer;

class ObserverInCod
{

}


class Baba {
    /** @var Observer[] */
    private array $observers = [];

    function addObserver(Observer $observer)
    {
        $this->observers []= $observer;
    }

    function aflaBarfa(string $barfa)
    {
        foreach ($this->observers as $ob) {
            $ob->notify($barfa);
        }
    }
}

interface Observer {
    function notify(string $barfa);
}

/////////
// -------------------- architecture is the art of drawing lines -------------------------


class CostelDeLa4 implements Observer {
    function notify(string $barfa)
    {
        echo "Breaking news (Costel): $barfa \n";
    }
}
class LeanaDeLa6 implements Observer {
    function notify(string $barfa)
    {
        echo "Breaking news (Leana): $barfa \n";
    }
}

$baba = new Baba();
$baba->addObserver(new CostelDeLa4());
$baba->addObserver(new LeanaDeLa6());

$baba->aflaBarfa("Rita a venit cu un pletos");