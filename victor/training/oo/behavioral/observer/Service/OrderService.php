<?php

namespace MS\ExamplePHP\ObserverPattern\Service;

use MS\ExamplePHP\ObserverPattern\Event\OrderCreateEvent;
use MS\ExamplePHP\ObserverPattern\Model\Order;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class OrderService
{
    public const ORDER_CREATE_EVENT = 'order.create';
    protected EventDispatcherInterface $dispatcher;
    protected  DeliveryService $deliveryService;
    protected InvoiceService $invoiceService;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function createOrder(array $array)
    {
        $order = new Order();
        $order->loadFromArray($array);


        // SOLUTIA 1:
        // + mai simplu de navigat
        $this->deliveryService->createDelivery();
        $this->invoiceService->createInvoice();
        // ... plus 5 altele si asta ar CUPLA clasa mea la celelalte

        // SOLUTIA 2
        // DE CE AI FACE ASTA ?
        // + un singur verify(), nu 7
        // + daca nu te intereseaza ce-i pe partea cealalta.
        // ! by default symphony invoca toti listenerii secvential, intr-o ordine oarecare.
        $this->dispatcher->dispatch(self::ORDER_CREATE_EVENT, new OrderCreateEvent($order));
    }
}

