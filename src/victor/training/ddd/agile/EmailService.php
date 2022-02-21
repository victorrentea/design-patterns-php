<?php

namespace victor\training\ddd\agile;

class EmailService
{
    private SprintRepo $sprintRepo;
    private MailingListService $mailingListService;


    public function __construct(SprintRepo $sprintRepo, MailingListService $mailingListService
        , EventDispatcherInterface $eventPublisher)
    {
        $eventPublisher->addListener('sprint.completed.event', [$this, 'onAllItemsInSprintCompleted']);

        $this->sprintRepo = $sprintRepo;
        $this->mailingListService = $mailingListService;
    }

    // SOlutia 2: Domain Events
    function onAllItemsInSprintCompleted(int $sprintId)
    {
        $sprint = $this->sprintRepo->findOneById($sprintId);
        echo "Sending CONGRATS email to team of product " . $sprint->getProduct()->getCode() . ": They finished the items earlier. They have time to refactor! (OMG!)";
        $emails = $this->mailingListService->retrieveEmails($sprint->getProduct()->getTeamMailingList());
        $this->sendCongratsEmail($emails);
    }

    public function sendCongratsEmail(array $emails): void
    {
        echo "Sending email: Subject: Congrats! / Body: You have finished the sprint earlier. You have more time for refactor!";
   }

    public function sendNotDoneItemsDebrief(string $ownerEmail, array $notDoneItems): void
    {
        echo "The team was unable to declare 'DONE' the following items this iteration: " . notDoneItems;
    }
}