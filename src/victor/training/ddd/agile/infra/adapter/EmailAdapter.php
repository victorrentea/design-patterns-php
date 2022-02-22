<?php

namespace victor\training\ddd\agile\application\service;

use victor\training\ddd\agile\domain\repo\ProductRepo;
use victor\training\ddd\agile\domain\repo\SprintRepo;
use victor\training\ddd\agile\domain\service\MailingListServiceInterface;
use victor\training\ddd\agile\EventDispatcherInterface;
use victor\training\ddd\agile\infra\MailingListApiAdapter;
use victor\training\ddd\common\EmailSender;

class EmailAdapter implements EmailSenderInterface
{
    /** @var SprintRepo */
    private SprintRepo $sprintRepo;
    private ProductRepo $productRepo;
    private MailingListServiceInterface $mailingListService;
    private EmailSender $emailSender;


    public function __construct(SprintRepo  $sprintRepo, MailingListServiceInterface $mailingListService
        , EventDispatcherInterface          $eventPublisher,
                                ProductRepo $productRepo,
                                EmailSender $emailSender)
    {
        $eventPublisher->addListener('sprint.completed.event', [$this, 'onAllItemsInSprintCompleted']);
        $this->sprintRepo = $sprintRepo;
        $this->mailingListService = $mailingListService;
        $this->productRepo = $productRepo;
        $this->emailSender = $emailSender;
    }

    // SOlutia 2: Domain Events
    function onAllItemsInSprintCompleted(int $sprintId)
    {
        $sprint = $this->sprintRepo->findOneById($sprintId);
        $product = $this->productRepo->findOneById($sprint->getProductId());
        echo "Sending CONGRATS email to team of product " . $product->getCode() . ": They finished the items earlier. They have time to refactor! (OMG!)";
        $emails = $this->mailingListService->retrieveEmails($product->getTeamMailingList());
        $this->sendCongratsEmail($emails);
    }

    private function sendCongratsEmail(array $emails): void
    {
        $this->emailSender->sendEmail("Congrats!",
            "You have finished the sprint earlier. You have more time for refactor!",
        $emails);
    }

    public function sendNotDoneItemsDebrief(string $ownerEmail, array $notDoneItems): void
    {
        echo "The team was unable to declare 'DONE' the following items this iteration: " . $notDoneItems;
    }
}
