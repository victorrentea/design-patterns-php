<!---->
<?php
//
//
//namespace victor\training\oo\creational\singleton;
//
//
//class ClasaDeTestat
//{
//    private IB $b;
//
//    public function __construct(IB $b)
//    {
//        $this->b = $b;
//    }
//
//    public function metDeBiz() {
//        // logica de aici
////        (new B())->met(); // 15 in urma
//
//        /** @var B $b */
////        $b = ServiceLocator::getObject(B::class);
////        $b->met();
//
//        $this->b->met(); // acum
//    }
//}
//
//class ServiceLocator {
//
//    static private array $registry = [];
//    static public array $mockedClassesFromTESTS = []; // in productie ramane gol
//
//    public static function getObject(string $class)
//    {
//        if (isset($class, self::$mockedClassesFromTESTS)) {
//            return self::$mockedClassesFromTESTS[$class];
//        }
//        if (isset($class, self::$registry)) {
//            return self::$registry[$class];
//        }
//
//        $newInstance = new $class;
//        self::$registry[$class] = $newInstance;
//        return $newInstance;
//    }
//}
//
//class Testul {
//    /** @test */
//    public function test1() {
////        ServiceLocator::$mockedClassesFromTESTS["\victor\training\oo\creational\singleton\B"] = mock(B::class);
////        new ClasaDeTestat(mock(B)) -- < astazi
//
//        (new B) -> met();
//        (new B) -> met();
//        new ClasaDeTestat(new BRO());
//        new ClasaDeTestat(new BHU());
////        (new BRO()) ->
//    }
//}
//
//
//interface IB {
//    function met();
//}
//
//class BRO implements IB {
//    public function met()
//    {
//       // tip Romanica
//        $this->f();
//    }
//
//    private function f()
//    {
//    }
//
//}
//class BHU implements IB {
//    public function met()
//    {
//       // a la Hungarica
//    }
//}