<?php


namespace victor\training\oo\behavioral\command;

class CreatePizzaCommand implements ICommand
{

    public function __construct(private PizzaMan $pizzaMan, private string $pizzaType, private string $crustType)
    {
    }

    public function getCrustType(): string
    {
        return $this->crustType;
    }

    public function getPizzaType(): string
    {
        return $this->pizzaType;
    }

    function execute()
    {
        $this->pizzaMan->bakePizza($this->getPizzaType(), $this ->getCrustType() );
    }
}