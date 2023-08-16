<?php

namespace App\Repository;

use App\Entity\Listing;
use App\Entity\ListingImage;
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

    public function createListing(array $data, array $images): Listing
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
            ->setDiscountedPrice($data['discountedPrice'])
            ->setLatitude($data['latitude'])
            ->setLongitude($data['longitude'])
        ;

        $this->addImages($listing, $images);
        return $listing;
    }

    private function addImages(Listing $listing, array $images): void
    {
        $entityManager = $this->getEntityManager();
        $listingImageRepository = $entityManager->getRepository(ListingImage::class);
        foreach ($images as $image) {
            $listingImage = $listingImageRepository->createListingImage($image);
            $listing->addImage($listingImage);
            $listingImage->setListing($listing);

            $entityManager->persist($listingImage);
        }
    }
}
