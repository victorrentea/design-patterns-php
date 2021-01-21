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


class EmailSender {
    private const MAX_RETRIES = 3;

    /**
     * @param string $emailAddress
     * @param callable $composerFn a function that take Email and fills subject and body
     */
    public function sendEmail(string $emailAddress, callable $composerFn): void {
        $context = new EmailContext(/*smtpConfig,etc*/);
        for ($i = 0; $i < self::MAX_RETRIES; $i++) {
            $email = new Email();
            $email->setSender('noreply@emag.ro');
            $email->setReplyTo('/dev/null');
            $email->setTo($emailAddress);
            $composerFn($email);
            $success = $context->send($email);
            if ($success) break;
        }
        // persit in db
    }
}

// class A  {
//     function __invoke(int $ceva) {
//         echo "PANICA!";
//     }
// }
// $a = new A();
// $a(1);

// interface EmailComposerInterface {
//     function __invoke(Email $email): void;
// }
//
// class OrderReceivedEmailComposer implements EmailComposerInterface
// {
//     function __invoke(Email $email): void
//     {
//         $email->setSubject('Order Received');
//         $email->setBody('Thank you for your order');
//     }
// }


class Emails {
    public function composeOrderReceived(Email $email): void {
        $email->setSubject('Order Received');
        $email->setBody('Thank you for your order');
    }
    public function composeOrderShipped(Email $email): void {
        $email->setSubject('Order Shipped');
        $email->setBody('Ti-am trimis. Speram sa ajunga (de data asta).');
    }
}

// new EmailSender()->send(orderEmail)


//Evolutie: implement sendOrderShippedEmail, la fel cum am trimis si la order received.


$sender = new EmailSender();
// ($sender)->sendEmail("a@b.com", function (Email $email): void {
//     $email->setSubject('Order Received');
//     $email->setBody('Thank you for your order');
// });
// cam miroase a anonymous stuff. Dac e multa logica, merita o functie. 


$emails = new Emails();

($sender)->sendEmail("a@b.com", [$emails, "composeOrderReceived"]);
($sender)->sendEmail("a@b.com", [$emails, "composeOrderShipped"]);


// class CodClient {
//     // #inject
//     private EmailSender $emailSender;
// }