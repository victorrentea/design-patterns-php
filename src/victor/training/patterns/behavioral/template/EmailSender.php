<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 12:28 AM
 */

namespace victor\training\patterns\behavioral\template;

use phpDocumentor\Reflection\Types\Callable_;

include "Email.php";
include "EmailClient.php";

class EmailSender
{
    private const MAX_RETRIES = 3;

    public function sendEmail(string $emailAddress): void
    {
        $context = new EmailClient(/*smtpConfig,etc*/);
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
    public function composeEmail(Email $email): void
    {
        $email->setSubject('Order Received');
        $email->digitallySign();
        $email->setBody('Thank you for your order');
    }
}
class Hackareala extends  EmailSender
{
    public function composeEmail(Email $email): void
    {
        $email->setSubject('Order Shipped');
        $email->setBody('Ti-am trimis, speram s-ajunga');
    }
}
//interface EmailComposer
//class OrderShippedEmailComposer implements EmailComposer
//class OrderPlacedEmailComposer implements EmailComposer

(new EmailSender())->sendEmail('a@b.com');

(new Hackareala())->sendEmail('a@b.com');

//CHANGE request: implement sendOrderShippedEmail