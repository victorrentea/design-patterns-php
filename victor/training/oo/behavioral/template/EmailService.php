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

    public function sendEmail(string $emailAddress, string $emailType): void
    {
        $context = new EmailContext(/*smtpConfig,etc*/);
        for ($i = 0; $i < self::MAX_RETRIES; $i++) {
            $email = new Email();
            $email->setSender('noreply@corp.com');
            $email->setReplyTo('/dev/null');
            $email->setTo($emailAddress);
            if ($emailType == "ORDER_SHIPPED") {
                $email->setSubject('Order Shipped');
                $email->setBody('Ti-am trimis, speram s-ajunga de data asta!');
            } elseif ($emailType == "ORDER_RECEIVED") {
                $email->setSubject('Order Received');
                $email->setBody('Thank you for your order');
            }
            $success = $context->send($email);
            if ($success) break;
        }
    }
}

$emailService = new EmailService();
$emailService->sendEmail('a@b.com', 'ORDER_RECEIVED');
$emailService->sendEmail('a@b.com', 'ORDER_SHIPPED');

//CHANGE request: implement sendOrderShippedEmail