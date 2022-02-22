<?php
/**
 * Created by IntelliJ IDEA.
 * User: VictorRentea
 * Date: 9/19/2017
 * Time: 12:28 AM
 */

namespace victor\training\oo\behavioral\template;

include "Email.php";
include "EmailContext.php";

interface EmailComposerInterface
{
    function composeEmail(Email $email): void;
}

class EmailSender
{
    private const MAX_RETRIES = 3;
    private EmailComposerInterface $emailComposer;

    public function __construct(EmailComposerInterface $emailComposer)
    {
        $this->emailComposer = $emailComposer;
    }

    // public function sendOrderShippedEmail(string $emailAddress) {
    //     $this->sendEmail($emailAddress, "Subj1", "Body1");
    // }
    // public function sendOrderReceivedEmail(string $emailAddress) {
    //     $this->sendEmail($emailAddress, "Subj3", "Body3");
    // }

    public function sendEmail(string $emailAddress/*, string $subject, string $body*/): void
    {
        $context = new EmailContext(/*smtpConfig,etc*/);
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

class OrderShippedEmailComposer implements EmailComposerInterface
{
    public function composeEmail(Email $email): void
    {
        $email->setSubject('Order Shipped');
        $email->setBody('Ti-am trimis, speram s-ajunga de data asta!');
    }
}

class OrderReceivedEmailComposer implements EmailComposerInterface
{
    public function composeEmail(Email $email): void
    {
        $email->setSubject('Order Received');
        $email->setBody('Thank you for your order');
    }
}

(new EmailSender(new OrderReceivedEmailComposer()))->sendEmail('a@b.com', 'ORDER_RECEIVED');
(new EmailSender(new OrderShippedEmailComposer()))->sendEmail('a@b.com', 'ORDER_SHIPPED');

//CHANGE request: implement sendOrderShippedEmail