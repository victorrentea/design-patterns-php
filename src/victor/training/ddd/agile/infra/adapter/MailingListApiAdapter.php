<?php

namespace victor\training\ddd\agile\infra;

use victor\training\ddd\agile\domain\service\MailingListServiceInterface;

class MailingListApiAdapter implements MailingListServiceInterface
{
    /** @return string[] */
    public function retrieveEmails(string $mailingList): array
    {
        $emails = []; // TODOREST CALL to http://localhost:8989/mailing-list/" + mailingList
        return $emails;
    }
}