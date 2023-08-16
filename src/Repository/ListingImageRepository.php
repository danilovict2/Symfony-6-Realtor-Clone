<?php

namespace App\Repository;

use App\Entity\Listing;
use App\Entity\ListingImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @extends ServiceEntityRepository<ListingImage>
 *
 * @method ListingImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListingImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListingImage[]    findAll()
 * @method ListingImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListingImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, #[Autowire('%photo_dir%')] private string $photoDir)
    {
        parent::__construct($registry, ListingImage::class);
    }

    public function createListingImage(UploadedFile $file): ListingImage
    {
        $filename = bin2hex(random_bytes(6)) . '.' . $file->guessExtension();
        $file->move($this->photoDir, $filename);

        $listingImage = new ListingImage();
        $listingImage->setImage($filename);

        return $listingImage;
    }
}
