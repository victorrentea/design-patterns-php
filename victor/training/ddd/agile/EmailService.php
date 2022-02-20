<?php

namespace victor\training\ddd\agile;

class EmailService
{
    public function sendCongratsEmail(array $emails): void
    {
        echo "Sending email: Subject: Congrats! / Body: You have finished the sprint earlier. You have more time for refactor!";
   }

    public function sendNotDoneItemsDebrief(string $ownerEmail, array $notDoneItems): void
    {
        echo "The team was unable to declare 'DONE' the following items this iteration: " . notDoneItems;
    }
}