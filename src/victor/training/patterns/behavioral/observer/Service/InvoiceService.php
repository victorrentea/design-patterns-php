<?php

namespace MS\ExamplePHP\ObserverPattern\Service;

use MS\ExamplePHP\ObserverPattern\Event\OrderCreateEvent;
use MS\ExamplePHP\ObserverPattern\Model\Delivery;
use MS\ExamplePHP\ObserverPattern\Model\Invoice;
use MS\ExamplePHP\ObserverPattern\Model\Order;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class InvoiceService
{
    protected EventDispatcherInterface $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;

        $dispatcher->addListener('order.stock.reserved.event', [$this, 'onOrderCreate']);
    }

    public function onOrderCreate(OrderCreateEvent $event)
    {
        $order = $event->getOrder();
        $this->createInvoice($order);
    }

    public function createInvoice(Order $order)
    {
        $delivery = new Invoice();
        $delivery->loadFromOrder($order);

        /* @TODO validate and persist data */
    }
}
