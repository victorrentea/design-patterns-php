<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 12:28 AM
 */

namespace victor\training\oo\behavioral\template;

use phpDocumentor\Reflection\Types\Callable_;

include "Email.php";
include "EmailContext.php";

abstract class AbstractEmailSender
{
    private const MAX_RETRIES = 3;

    public function send(string $emailAddress): void
    {
        $context = new EmailContext(/*smtpConfig,etc*/);
        for ($i = 0; $i < self::MAX_RETRIES; $i++) {
            $email = new Email();
            $email->setSender('noreply@corp.com');
            $email->setReplyTo('/dev/null');
            $email->setTo($emailAddress);
            $this->composeEmail($email);
            $success = $context->send($email);
            if ($success) break;
        }
    }
    protected abstract function composeEmail(Email $email): void;
}

class OrderReceivedEmailSender extends AbstractEmailSender
{
    protected function composeEmail(Email $email): void
    {
        $email->setSubject('Order Received');
        $email->setBody('Thank you for your order');
    }
}

class OrderShippedEmailSender extends AbstractEmailSender {
    protected function composeEmail(Email $email): void
    {
        $email->setSubject('Order Shipped');
        $email->setBody('Ti-am trimis. Speram sa ajunga (de data asta)');
    }
}

//cod existent
(new OrderReceivedEmailSender())->send('a@b.com');

//CHANGE request: implement sendOrderShippedEmail
(new OrderShippedEmailSender())->send('a@b.com');
