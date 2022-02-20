<?php

namespace victor\training\ddd\agile;

class MailingListService
{
    /** @return string[] */
    public function retrieveEmails(string $mailingList): array
    {
        $emails = []; // TODOREST CALL to http://localhost:8989/mailing-list/" + mailingList
        return $emails;
    }
}