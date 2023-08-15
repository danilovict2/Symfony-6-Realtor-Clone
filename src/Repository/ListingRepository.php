<?php

namespace App\Repository;

use App\Entity\Listing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Listing>
 *
 * @method Listing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Listing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Listing[]    findAll()
 * @method Listing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Listing::class);
    }

    public function createListing(array $data): Listing
    {
        $listing = new Listing();
        $listing->setType($data['type'])
            ->setName($data['name'])
            ->setBedrooms($data['bedrooms'])
            ->setBathrooms($data['bathrooms'])
            ->setParking($data['parking'])
            ->setAddress($data['address'])
            ->setFurnished($data['furnished'])
            ->setDescription($data['description'])
            ->setRegularPrice($data['regularPrice'])
            ->setLatitude($data['latitude'])
            ->setLongitude($data['longitude'])
        ;
        return $listing;
    }
}
