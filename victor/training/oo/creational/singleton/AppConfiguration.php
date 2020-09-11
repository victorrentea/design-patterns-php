<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/17/2017
 * Time: 7:42 PM
 */

namespace victor\training\oo\behavioral\singleton;


class OrderService {
    private OrderRepo $repo;
    private AppConfiguration $config;

    //container
    public function __construct(OrderRepo $repo, AppConfiguration $config)
    {
        $this->repo = $repo;
        $this->config = $config;
    }

}

class OrderServiceTest {
    private OrderService  toTest = new OrderService(mockRepo, mockConfig); // TODO
}


class AppConfiguration
{

    //al mano ----> sau responsabilitatea containerului
    static private AppConfiguration $INSTANCE;

    public static function getInstance() {
        if (! self::$INSTANCE) {
            self::$INSTANCE = new self();
        }
        return self::$INSTANCE;
    }
//
//    /**
//     * @param AppConfiguration $INSTANCE
//     */
//    public static function setINSTANCEForTests(AppConfiguration $INSTANCE): void
//    {
//        self::$INSTANCE = $INSTANCE;
//    }


    private function __construct()
	{
        printf("Creating singleton instance\n");
        $this->properties = $this->readConfiguration();
    }
	
     static  private $properties;

    private function readConfiguration(): array {
        printf("Fetching properties from Tahiti...\n");
        sleep(2);
        printf("Decrypting properties...\n");
        sleep(1);
        return parse_ini_file('props.ini');
    }

    public function getProperty(string $propertyName): string {
        return self::$properties[$propertyName];
    }
}
global $properties ;