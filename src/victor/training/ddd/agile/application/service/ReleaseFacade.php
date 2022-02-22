<?php

namespace victor\training\ddd\agile\application\service;

use victor\training\ddd\agile\domain\repo\ProductBacklogItemRepo;
use victor\training\ddd\agile\domain\repo\ProductRepo;
use victor\training\ddd\agile\domain\repo\ReleaseRepo;
use victor\training\ddd\agile\domain\repo\SprintRepo;
use victor\training\ddd\agile\Release;
use victor\training\ddd\agile\Sprint;
use victor\training\ddd\agile\SprintBacklogItem;

class ReleaseFacade
{
    private ReleaseRepo $releaseRepo;
    private ProductRepo $productRepo;
    private ProductBacklogItemRepo $productBacklogItemRepo;
    private SprintRepo $sprintRepo;

    public function __construct(ReleaseRepo $releaseRepo, ProductRepo $productRepo, SprintRepo $sprintRepo, \victor\training\ddd\agile\domain\repo\ProductBacklogItemRepo $productBacklogItemRepo)
    {
        $this->releaseRepo = $releaseRepo;
        $this->productRepo = $productRepo;
        $this->sprintRepo = $sprintRepo;
        $this->productBacklogItemRepo = $productBacklogItemRepo;
    }


    public function createRelease(int $productId, int $sprintId): Release
    {
        $product = $this->productRepo->findOneById($productId);
        $sprint = $this->sprintRepo->findOneById($sprintId);

        $previousReleasedIteration = 0;
        foreach ($product->getReleases() as $pastRelease) {
            $releasedIteration = $pastRelease->getSprint()->getIteration();
            if ($releasedIteration > $previousReleasedIteration) {
                $previousReleasedIteration = $releasedIteration;
            }
        }

        $toIteration = $sprint->getIteration();

        $sprints = $product->getSprints();
        usort($sprints, fn(Sprint $s1, Sprint $s2) => $s2->getIteration() - $s1->getIteration());
        /** @var SprintBacklogItem[] $releasedItems */
        $releasedItems = [];
        foreach ($sprints as $sprint) {
            if ($sprint->getIteration() > $previousReleasedIteration && $sprint->getIteration() <= $toIteration) {
                foreach ($sprint->getItems() as $backlogItem) {
                    $releasedItems [] = $backlogItem;
                }
            }
        }
        // iteratia 1 2 3(RELEASED) 4 5 6 7(RELEASED)


        // $productBacklogItem = $this->productBacklogItemRepo->findOneByIdList($listCuToateIdurile); // TODO pt performanta
        $releaseNotes = "";
        foreach ($releasedItems as $sprintBacklogItem) {
            $productBacklogItem = $this->productBacklogItemRepo->findOneById($sprintBacklogItem->getProductBacklogItemId());
            $releaseNotes .= $productBacklogItem->getTitle() . "\n";
        }

        $release = (new Release())
            ->setSprint($sprint)
            ->setReleaseNotes($releaseNotes)
            ->setDate(new \DateTime())
            ->setVersion($product->incrementAndGetVersion() . ".0");
        $product->addRelease($release);

        $this->releaseRepo->save($release);
        return $release;
    }
}