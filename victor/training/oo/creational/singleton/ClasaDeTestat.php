
<?php


namespace victor\training\oo\creational\singleton;


class ClasaDeTestat
{
    private $b;

    public function __construct(B $b)
    {
        $this->b = $b;
    }

    public function metDeBiz() {
        // logica de aici
//        (new B())->met(); // 15 in urma

        /** @var B $b */
//        $b = ServiceLocator::getObject(B::class);
//        $b->met();

        $this->b->met(); // acum
    }
}

class ServiceLocator {

    static private $registry = [];
    static public $mockedClassesFromTESTS = []; // in productie ramane gol

    public static function getObject(string $class)
    {
        if (isset($class, self::$mockedClassesFromTESTS)) {
            return self::$mockedClassesFromTESTS[$class];
        }
        if (isset($class, self::$registry)) {
            return self::$registry[$class];
        }

        $newInstance = new $class;
        self::$registry[$class] = $newInstance;
        return $newInstance;
    }
}

class Testul {
    /** @test */
    public function test1() {
//        ServiceLocator::$mockedClassesFromTESTS["\victor\training\oo\creational\singleton\B"] = mock(B::class);
//        new ClasaDeTestat(mock(B)) -- < astazi

        (new B) -> met();
        (new B) -> met();
    }
}


class B {

    public function met()
    {
        // ceva cu fisiere/ DB/ REST/ gherkin/rabbit
    }
}