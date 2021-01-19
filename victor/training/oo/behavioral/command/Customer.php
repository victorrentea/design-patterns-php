<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/18/2017
 * Time: 11:32 PM
 */

namespace victor\training\oo\behavioral\command;

include "Barman.php";
include "PizzaMan.php";
// include "Waitress.php";
// include "PizzaCommand.php";

class Customer
{
    private Barman $barman;
    private PizzaMan $pizzaMan;

    public function __construct(Barman $barman, PizzaMan $pizzaMan)
    {
        $this->barman = $barman;
        $this->pizzaMan = $pizzaMan;
    }


    public function act() {
        printf("Shouting for a pizza and beer!\n");
		$this->pizzaMan->bakePizza("Capriciosa", "thin");
		$this->barman->pourBeer("Tuborg");
	}

}

$pizzaMan = new PizzaMan();
$barman = new Barman();
$customer = new Customer($barman, $pizzaMan);
$customer->act();
$customer->act();
$customer->act();
$customer->act();
