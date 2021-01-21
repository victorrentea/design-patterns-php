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

// new EmailSender()->send(orderEmail)

// (new OrderReceivedEmailSender())->sendEmail('a@b.com');
// (new OrderShippedEmailSender())->sendEmail('a@b.com');

class EmailSender
{
    private const MAX_RETRIES = 3;
    private EmailSenderInterface $composer;

    public function __construct(EmailSenderInterface $composer)
    {
        $this->composer = $composer;
    }

    public function sendEmail(string $emailAddress): void
    {
        $context = new EmailContext(/*smtpConfig,etc*/);
        for ($i = 0; $i < self::MAX_RETRIES; $i++) {
            $email = new Email();
            $email->setSender('noreply@emag.ro');
            $email->setReplyTo('/dev/null');
            $email->setTo($emailAddress);
            $this->composer->compose($email);
            $success = $context->send($email);
            if ($success) break;
        }
        // persit in db
    }
}

interface EmailSenderInterface {
    function compose(Email $email): void;
}
class OrderReceivedEmailSender implements  EmailSenderInterface {
    public function compose(Email $email): void
    {
        $email->setSubject('Order Received');
        $email->setBody('Thank you for your order');
    }
}


class OrderShippedEmailSender implements  EmailSenderInterface {
    public function compose(Email $email): void
    {
        $email->setSubject('Order Shipped');
        $email->setBody('Ti-am trimis. Speram sa ajunga (de data asta).');
    }
}

//Evolutie: implement sendOrderShippedEmail, la fel cum am trimis si la order received.


(new EmailSender(new OrderReceivedEmailSender()))->sendEmail("a@b.com");
(new EmailSender(new OrderShippedEmailSender()))->sendEmail("a@b.com");
