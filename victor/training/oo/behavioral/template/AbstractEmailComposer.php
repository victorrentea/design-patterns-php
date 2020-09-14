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

class EmailSender
{
    private const MAX_RETRIES = 3;
    private EmailComposer $composer;

    public function __construct(EmailComposer $composer)
    {
        $this->composer = $composer;
    }


    public function send(string $emailAddress): void
    {
        $context = new EmailContext(/*smtpConfig,etc*/);
        for ($i = 0; $i < self::MAX_RETRIES; $i++) {
            $email = new Email();
            $email->setSender('noreply@corp.com');
            $email->setReplyTo('/dev/null');
            $email->setTo($emailAddress);
            $this->composer->composeEmail($email);
            $success = $context->send($email);
            if ($success) break;
        }
    }
}
interface EmailComposer {

    public function composeEmail(Email $email): void;
}

class OrderReceivedEmailComposer implements EmailComposer
{
    public function composeEmail(Email $email): void
    {
        $email->setSubject('Order Received');
        $email->setBody('Thank you for your order');
    }
}

class OrderShippedEmailComposer implements EmailComposer {
    public function composeEmail(Email $email): void
    {
        $email->setSubject('Order Shipped');
        $email->setBody('Ti-am trimis. Speram sa ajunga (de data asta)');
    }
}

//cod existent
(new EmailSender(new OrderReceivedEmailComposer()))->send('a@b.com');

//CHANGE request: implement sendOrderShippedEmail
(new EmailSender(new OrderShippedEmailComposer()))->send('a@b.com');
