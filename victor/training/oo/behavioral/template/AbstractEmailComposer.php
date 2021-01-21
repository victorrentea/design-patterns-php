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


abstract class EmailSender
{
    private const MAX_RETRIES = 3;

    /**
     * @param string $emailAddress
     * @param callable $composer a function that take Email and fills subject and body
     */
    public function sendEmail(string $emailAddress): void
    {
        $context = new EmailContext(/*smtpConfig,etc*/);
        for ($i = 0; $i < self::MAX_RETRIES; $i++) {
            $email = new Email();
            $email->setSender('noreply@emag.ro');
            $email->setReplyTo('/dev/null');
            $email->setTo($emailAddress);
            $this->compose($email);
            $success = $context->send($email);
            if ($success) break;
        }
        // persit in db
    }

    protected abstract function compose(Email $email): void;

    protected function escapeTitle(string $string): string
    {
        return strtoupper($string);
    }
}

class OSEC extends EmailSender
{
    public function compose(Email $email): void
    {
        $email->setSubject($this->escapeTitle('Order <script Received'));
        $email->setBody('Thank you for your order');
    }
}

class OREC extends EmailSender
{
    public function compose(Email $email): void
    {
        $email->setSubject($this->escapeTitle('Order Shipped'));
        // multa logica
        $email->setBody('Ti-am trimis. Speram sa ajunga (de data asta).');
        // aici scrii export data pe fisierul primit parametru
    }

}

// class A
// {
//     private ABC $abc;
//     private D $d;
//
//     /**
//      * @param ABC $abc
//      */
//     public function setAbc(ABC $abc): void
//     {
//         $this->abc = $abc;
//     }
//
//     /**
//      * @param D $d
//      */
//     public function setD(D $d): void
//     {
//         $this->d = $d;
//     }
// }

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