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
include "ICommand.php";
include "CreatePizzaCommand.php";
include "CreateBeerCommand.php";
// include "Waitress.php";
// include "PizzaCommand.php";

class Customer
{
    public function __construct(private Waitress $waitress)
    {
    }

    public function act()
    {
        printf("Shouting for a pizza and beer!\n");
        $this->waitress->orderPizza("Capriciosa", "thin");
        $this->waitress->orderBeer("Tuborg");
    }

}

class Waitress
{
    /** @var ICommand[] */
    private $commandQueue = [];

    public function __construct(private Barman $barman, private PizzaMan $pizzaMan)
    {
    }

    public function orderPizza(string $pizzaType, string $crustType)
    {
        $this->commandQueue[] = new CreatePizzaCommand($this->pizzaMan, $pizzaType, $crustType);
    }

    public function orderBeer(string $beerType)
    {
        $this->commandQueue[] = new CreateBeerCommand($this->barman, $beerType);
    }

    public function flushCommands()
    {
        foreach ($this->commandQueue as $command) {
            $command->execute();
        }
    }
}


$pizzaMan = new PizzaMan();
$barman = new Barman();
$waitress = new Waitress($barman, $pizzaMan);
$customer = new Customer($waitress);
$customer->act();
$customer->act();
$customer->act();
$customer->act();

$waitress->flushCommands();


class ESMapper {
    static function stuff(int $i) {


        echo "Treaba $i";
        echo "Treaba $i";
        echo "Treaba $i";
    }
}