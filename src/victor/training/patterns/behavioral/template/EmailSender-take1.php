<?php
///**
// * Created by IntelliJ IDEA.
// * User: VictorRentea
// * Date: 9/19/2017
// * Time: 12:28 AM
// */
//
//namespace victor\training\patterns\behavioral\template;
//
//use phpDocumentor\Reflection\Types\Callable_;
//
//include "Email.php";
//include "EmailClient.php";
//
//class EmailSender
//{
//    private const MAX_RETRIES = 3;
//
//
//    function sendOrderPlacedEmail(string $emailAddress)
//    {
//        $email = $this->getEmailTemplate();
//        $email->setSubject('Order Received');
//        $email->setBody('Thank you for your order');
//        $this->sendEmail($emailAddress, $email);
//    }
//
//    function sendOrderShippedEmail(string $emailAddress)
//    {
//        $email = $this->getEmailTemplate();
//        $email->setSubject('Order Shipped');
//        $email->setBody('Ti-am trimis, speram s-ajunga!');
//        $this->sendEmail($emailAddress, $email);
//    }
//
//    private function sendEmail(string $emailAddress, Email $email): void
//    {
//        $client = new EmailClient(/*smtpConfig,etc*/);
//        for ($i = 0; $i < self::MAX_RETRIES; $i++) {
////            $email = new Email();
////            $email->setSender('noreply@emag.bg');
////            $email->setReplyTo('/dev/null');
////            $email->setTo($emailAddress);
//            $success = $client->send($email);
//            if ($success) break;
//        }
//    }
//
//    private function getEmailTemplate(): Email {
//        $email = new Email();
//        $email->setSender('noreply@emag.bg');
//        $email->setReplyTo('/dev/null');
//        return $email;
//    }
//}
//
//$emailService = new EmailSender();
//
////class PlaceOrderService {
//    $emailService->sendOrderPlacedEmail("a@b.com");
////}
//
////class ShipOrderService {
//    $emailService->sendOrderShippedEmail("a@b.com");
////}
//
////$emailService->sendOrderShippedEmail('a@b.com');
//
////CHANGE request: implement sendOrderShippedEmail "LA FEL cum ai trimis si pe order received"
//
//// @Vlad evenimente - nu cred ca vreau sa cuplez codul care plaseaza comanda la acest EmailService
////    decuplez prin evenimente SURSA de EFECTOR
//// @Mariu : da daca maine le trimis prin posta o scrisoare ( ca e Amish)?
//
