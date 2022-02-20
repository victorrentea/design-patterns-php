<?php

namespace victor\training\ddd\agile;

interface ReleaseRepo
{
    public function save(Release $release): Release;
}

class ReleaseService
{
    private ReleaseRepo $releaseRepo;
    private ProductRepo $productRepo;
    private SprintRepo $sprintRepo;

    public function __construct(ReleaseRepo $releaseRepo, ProductRepo $productRepo, SprintRepo $sprintRepo)
    {
        $this->releaseRepo = $releaseRepo;
        $this->productRepo = $productRepo;
        $this->sprintRepo = $sprintRepo;
    }


    public function createRelease(int $productId, int $sprintId): Release
    {
        $product = $this->productRepo->findOneById($productId);
        $sprint = $this->sprintRepo->findOneById($sprintId);

        $fromIteration = 0;

        foreach ($product->getReleases() as $pastRelease) {
            $releasedIteration = $pastRelease->getSprint()->getIteration();
            if ($releasedIteration > $fromIteration) {
                $fromIteration = $releasedIteration;
            }
        }
        $toIteration = $sprint->getIteration();
        $sprints = $product->getSprints();
        usort($sprints, fn(Sprint $s1, Sprint $s2) => $s2->getIteration() - $s1->getIteration());
        /** @var BacklogItem[] releasedItems */
        $releasedItems = [];
        foreach ($sprints as $sprint) {
            if ($sprint->getIteration() >= $fromIteration && $sprint->getIteration() <= $toIteration) {
                foreach ($sprint->getItems() as $backlogItem) {
                    $releasedItems [] = $backlogItem;
                }
            }
        }

        $release = (new Release())
            ->setProduct($product)
            ->setSprint($sprint)
            ->setReleasedItems($releasedItems)
            ->setDate(new \DateTime())
            ->setVersion($product->incrementAndGetVersion() . ".0");
        $product->addRelease($release);

        $this->releaseRepo->save($release);
        return $release;
    }
}