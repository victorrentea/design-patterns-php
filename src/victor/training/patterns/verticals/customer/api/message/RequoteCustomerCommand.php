<?php

namespace victor\training\patterns\verticals\customer\api\message;

class RequoteCustomerCommand
{
    public int $customerId; // event notification > cerea un call inapoi pentru date.
    public string $newAddress; // + = Event-Carried State Transfer
        // schema pe eventuri + apoi v2
}