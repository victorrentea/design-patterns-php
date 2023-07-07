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

class EmailSender // poate fi singleton manageuit de symphony ? NU pt ca depinde de fluxul pe care esti ce Composer ii dai.
    // STATEFUL DESIGN e rau
{
    private const MAX_RETRIES = 3;

    public function __construct(readonly private EmailComposer $emailComposer) {}

    public function sendEmail(string $emailAddress): void
    {
        $context = new EmailClient(/*smtpConfig,etc*/);
        for ($i = 0; $i < self::MAX_RETRIES; $i++) {
            $email = new Email();
            $email->setSender('noreply@corp.com');
            $email->setReplyTo('/dev/null');
            $email->setTo($emailAddress);

            $this->emailComposer->composeEmail($email);

            $success = $context->send($email);
            if ($success) break;
        }
    }
}

interface EmailComposer {function composeEmail(Email $email);}

class OrderShippedEmailComposer implements EmailComposer
{
    function composeEmail(Email $email): void
    {
        $email->setSubject('Order Shipped');
        $email->setBody('Ti-am trimis, speram s-ajunga');
    }
}

class OrderPlacedEmailComposer implements EmailComposer
{
    function composeEmail(Email $email): void
    {
        $email->setSubject('Order Received');
        $email->digitallySign();
        $email->setBody('Thank you for your order');
    }
}

(new EmailSender(new OrderShippedEmailComposer()))->sendEmail('a@b.com');

(new EmailSender(new OrderPlacedEmailComposer()))->sendEmail('a@b.com');

//CHANGE request: implement sendOrderShippedEmail