<?php

namespace MS\ExamplePHP\ObserverPattern\Service;

use MS\ExamplePHP\ObserverPattern\Event\OrderCreateEvent;
use MS\ExamplePHP\ObserverPattern\Model\Delivery;
use MS\ExamplePHP\ObserverPattern\Model\Order;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class StockService
{
    protected EventDispatcherInterface $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;

        $this->dispatcher->addListener('order.create', [$this, 'onOrderCreate']);
        // sau din yaml
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

        // CORECT:
//        $this->dispatcher->dispatch("order.stock.reserved.event", new OrderStockReservedEvent($order->id));

        // GRESIT: asta nu e Event ci "Command" pattern.
        $this->dispatcher->dispatch("invoice.order.event", new InvoiceOrderEvent($order->id));

        // Event = s-a intamplat ceva
        // - in trecut
        // - 1..N listeneri
        // - senderul controleaza structura mesajului
        //   a) thin event Event{id}:
        //      MINUS: receiver calls you back (performance)
        //   b) fat event Event{date}:
        //      MINUS: datele din mesaj e posibil sa se fi schimbat deja cand mesaju intra in procesare
        //      MINUS: eventul tre sa aiba schema (versionat, etc..)

        // Command = cere sa se intample ceva, trimitand un obiect nu un APEL de metoda
        // - in viitor
        // - 1 receiver
        // - receiverul decide ce tre sa primeasca ~= "HTTP request payload"

        // Eventual Consistency
    }

    // woman = time * money  = money ^ 2 = evil ^ 2

}
