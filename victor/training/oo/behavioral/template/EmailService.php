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

class EmailService
{
    private const MAX_RETRIES = 3;

    public function sendOrderReceivedEmail(string $emailAddress, bool $cr323): void
    {
        $context = new EmailContext(/*smtpConfig,etc*/);
        for ($i = 0; $i < self::MAX_RETRIES; $i++) {
            $email = new Email();
            $email->setSender('noreply@corp.com');
            $email->setReplyTo('/dev/null');
            $email->setTo($emailAddress);
            if (!$cr323) {
                $email->setSubject('Order Received');
                $email->setBody('Thank you for your order');
            } else {
                $email->setSubject('Order Shipped');
                $email->setBody('Ti-am trimis. Speram sa ajunga (de data asta)');
            }
            $success = $context->send($email);
            if ($success) break;
        }
    }

}

$emailService = new EmailService();
//cod existent
$emailService->sendOrderReceivedEmail('a@b.com', false);

//CHANGE request: implement sendOrderShippedEmail
$emailService->sendOrderReceivedEmail('a@b.com', true);
