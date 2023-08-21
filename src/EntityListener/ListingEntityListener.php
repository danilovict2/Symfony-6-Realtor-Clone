<?php

namespace App\EntityListener;

use App\Entity\Listing;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

#[AsEntityListener(event: Events::preRemove, entity: Listing::class)]
class ListingEntityListener
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        #[Autowire('%photo_dir%')] private string $photoDir
    ) {
    }

    public function preRemove(Listing $listing, LifecycleEventArgs $event)
    {
        foreach ($listing->getImages() as $image) {
            unlink($this->photoDir . '/' . $image->getImage());
        }
    }
}
