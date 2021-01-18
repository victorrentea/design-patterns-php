<?php


namespace victor\training\oo;


class InheritanceERau
{

}


class Parinte {
    function portofel() {
        if (!$this->mamaDaVoie()) {
            throw new \Exception();
        }
        //20 linii de cod
        return 100;
    }

     function mamaDaVoie()
    {
        return false;
    }
}

class Copil extends  Parinte {

    function mersLaBar() {
        $bani = $this->portofel();
        echo "Beu $bani";
    }
    public function mamaDaVoie() {
        return true;
    }
}

