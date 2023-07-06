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
include "EmailContext.php";

class EmailSender
{
    private const MAX_RETRIES = 3;

    public function sendOrderReceivedEmail(string $emailAddress): void
    {
        $context = new EmailContext(/*smtpConfig,etc*/);
        for ($i = 0; $i < self::MAX_RETRIES; $i++) {
            $email = new Email();
            $email->setSender('noreply@corp.com');
            $email->setReplyTo('/dev/null');
            $email->setTo($emailAddress);
            $email->setSubject('Order Received');
            $email->setBody('Thank you for your order');
            $success = $context->send($email);
            if ($success) break;
        }
    }
}

$emailService = new EmailSender();
$emailService->sendOrderReceivedEmail('a@b.com');

//CHANGE request: implement sendOrderShippedEmail