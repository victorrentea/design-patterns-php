<?php

namespace MS\ExamplePHP\ObserverPattern\Service;

use MS\ExamplePHP\ObserverPattern\Event\OrderCreateEvent;
use MS\ExamplePHP\ObserverPattern\Model\Delivery;
use MS\ExamplePHP\ObserverPattern\Model\Order;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class DeliveryService
{
    protected EventDispatcherInterface $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;

        $this->dispatcher->addListener(OrderService::ORDER_CREATE_EVENT, [$this, 'onOrderCreate']);
    }

    public function onOrderCreate(OrderCreateEvent $event)
    {
        $order = $event->getOrder();
        $this->createDelivery($order);
    }

    public function createDelivery(Order $order)
    {
        $delivery = new Delivery();
        $delivery->loadFromOrder($order);

        /* @TODO validate and persist data */
    }
}
