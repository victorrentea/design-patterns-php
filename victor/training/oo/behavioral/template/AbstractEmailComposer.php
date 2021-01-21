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
    public function sendEmail(string $emailAddress, EmailComposerInterface $composer): void {
        $context = new EmailContext(/*smtpConfig,etc*/);
        for ($i = 0; $i < self::MAX_RETRIES; $i++) {
            $email = new Email();
            $email->setSender('noreply@emag.ro');
            $email->setReplyTo('/dev/null');
            $email->setTo($emailAddress);
            $composer->compose($email);
            $success = $context->send($email);
            if ($success) break;
        }
        // persit in db
    }
}
interface EmailComposerInterface {
    function compose(Email $email): void;
}
class OrderReceivedEmailComposer implements  EmailComposerInterface {
    public function compose(Email $email): void {
        $email->setSubject('Order Received');
        $email->setBody('Thank you for your order');
    }
}
class OrderShippedEmailComposer implements  EmailComposerInterface {
    public function compose(Email $email): void {
        $email->setSubject('Order Shipped');
        $email->setBody('Ti-am trimis. Speram sa ajunga (de data asta).');
    }
}

// new EmailSender()->send(orderEmail)


//Evolutie: implement sendOrderShippedEmail, la fel cum am trimis si la order received.


$sender = new EmailSender();
($sender)->sendEmail("a@b.com", new OrderReceivedEmailComposer());
($sender)->sendEmail("a@b.com", new OrderShippedEmailComposer());


// class CodClient {
//     // #inject
//     private EmailSender $emailSender;
// }