<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 3:28 PM
 */

namespace victor\training\oo\behavioral\command;


class PizzaCommand implements Command
{
    private PizzaMan $pizzaMan;

    private string $pizzaType;

    private string $crustType;

    public function __construct(PizzaMan $pizzaMan, string $pizzaType, string $crustType)
    {
        $this->pizzaMan = $pizzaMan;
        $this->pizzaType = $pizzaType;
        $this->crustType = $crustType;
    }

    public function execute() {
        $this->pizzaMan->bakePizza($this->pizzaType, $this->crustType);
    }

    public function getPizzaMan(): PizzaMan
    {
        return $this->pizzaMan;
    }

    public function getPizzaType(): string
    {
        return $this->pizzaType;
    }

    public function getCrustType(): string
    {
        return $this->crustType;
    }




}