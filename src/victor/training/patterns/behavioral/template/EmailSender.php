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

class EmailSender // poate fi singleton manageuit de symphony : DA
{
    private const MAX_RETRIES = 3;

//    public function __construct(readonly private EmailComposer $emailComposer) {} // code smell : temporary field

    public function sendEmail(string $emailAddress, callable $emailComposer): void
    {
        $context = new EmailClient(/*smtpConfig,etc*/);
        for ($i = 0; $i < self::MAX_RETRIES; $i++) {
            $email = new Email();
            $email->setSender('noreply@corp.com');
            $email->setReplyTo('/dev/null');
            $email->setTo($emailAddress);

            $emailComposer($email);

            $success = $context->send($email);
            if ($success) break;
        }
    }
}


class Emails // manageuit de symp
{
    function composeShippedEmail(Email $email): void
    {
        $email->setSubject('Order Shipped');
        $email->setBody('Ti-am trimis, speram s-ajunga');
    }
    function composePlacedEmail(Email $email): void
    {
        $email->setSubject('Order Received');
        $email->digitallySign();
        $email->setBody('Thank you for your order');
    }
}

$emails = new Emails();
$emailSender = new EmailSender(); // singleton

$emailSender->sendEmail('a@b.com', [$emails, 'composePlacedEmail']); // function references
$emailSender->sendEmail('a@b.com', [$emails, 'composeShippedEmail']);

//CHANGE request: implement sendOrderShippedEmail