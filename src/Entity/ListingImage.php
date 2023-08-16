<?php

namespace App\Entity;

use App\Repository\ListingImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListingImageRepository::class)]
class ListingImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Listing $listing = null;

    public function __toString()
    {
        return $this->image;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getListing(): ?Listing
    {
        return $this->listing;
    }

    public function setListing(?Listing $listing): static
    {
        $this->listing = $listing;

        return $this;
    }
}
