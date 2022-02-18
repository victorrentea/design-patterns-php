$<?php

namespace victor\training\oo\structural;

class StateSchita
{

}


class EntitateCuMulteStari {

    private string $state;

    function retur()
    {
        if ($this->state=='CREATED') {
            throw new \Exception("N-ai cum");
        } elseif ($this->state=='SHIPPED') ) {
            $this->state = "WAITING_RETUR_PICKUP";
        }
    }
    function trackPeUndeE()
    {
        if ($this->state=='CREATED') {
            return "in depozit";
        } elseif ($this->state=='SHIPPED')  {
            $sameday->localizeazaColet()
        }
    }
}

interface OrderState {
    function retur():OrderState;
    function trackPeUndeE():OrderState;
}

class CreatedState implements OrderState
{

    function retur(): OrderState
    {
        throw new \Exception("BUM");
    }

    function trackPeUndeE(): OrderState
    {
        // TODO: Implement trackPeUndeE() method.
    }
}

class ShippedState implements OrderState
{
    public function retur():OrderState {
        return ReturState();
    }
}
//1: f multe stari cu multe tranzitii complicate
//2: parsere> <aa><b><c><d>