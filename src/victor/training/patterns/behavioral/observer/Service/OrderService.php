<?php

namespace MS\ExamplePHP\ObserverPattern\Service;

use MS\ExamplePHP\ObserverPattern\Event\OrderCreateEvent;
use MS\ExamplePHP\ObserverPattern\Model\Order;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class OrderService implements OrderServiceInterface
{
    protected EventDispatcherInterface $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function createOrder(array $array)
    {

        $order = new Order();
        $order->loadFromArray($array);
// drame
// drame
// drame
// drame
// drame
// drame
// drame
// drame
// drame
// drame
// drame
// drame
// drame
// drame
// drame
// drame
// drame
// drame
// drame
        $this->dispatcher->dispatch('order.create', new OrderCreateEvent($order));
        return $order;
    }
}
