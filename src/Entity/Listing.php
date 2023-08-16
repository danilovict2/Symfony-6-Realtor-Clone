<?php

namespace App\Entity;

use App\Repository\ListingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ListingRepository::class)]
class Listing
{
    private const LARGEST_PRICE = 400000000;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message: 'Type is required!')]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Name is required!')]
    #[Assert\Length(max: 255, maxMessage: 'Your name cannot be longer than {{ limit }} characters')]
    private ?string $name = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\GreaterThanOrEqual(1, message: 'Your listing must have at least {{ compared_value }} bedroom')]
    private ?int $bedrooms = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\GreaterThanOrEqual(1, message: 'Your listing must have at least {{ compared_value }} bathroom')]
    private ?int $bathrooms = null;

    #[ORM\Column]
    private ?bool $parking = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Address is required!')]
    #[Assert\Length(max: 255, maxMessage: 'Your address cannot be longer than {{ limit }} characters')]
    private ?string $address = null;

    #[ORM\Column]
    private ?bool $furnished = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Description is required!')]
    #[Assert\Length(max: 255, maxMessage: 'Your description cannot be longer than {{ limit }} characters')]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Regular price is required!')]
    #[Assert\LessThanOrEqual(self::LARGEST_PRICE, message: "Price can't be larger than {{ compared_value }}$")]
    private ?int $regularPrice = null;

    #[ORM\Column(nullable: true)]
    #[Assert\LessThanOrEqual(self::LARGEST_PRICE, message: "Price can't be larger than {{ compared_value }}$")]
    private ?int $discountedPrice = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\GreaterThanOrEqual(-90, message: 'Please provide a real latitude!')]
    #[Assert\LessThanOrEqual(90, message: 'Please provide a real latitude!')]
    private ?int $latitude = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\GreaterThanOrEqual(-180, message: 'Please provide a real longitude!')]
    #[Assert\LessThanOrEqual(180, message: 'Please provide a real longitude!')]
    private ?int $longitude = null;

    #[ORM\ManyToOne(inversedBy: 'listings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createdBy = null;

    #[ORM\OneToMany(mappedBy: 'listing', targetEntity: ListingImage::class, orphanRemoval: true)]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(int $bedrooms): static
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    public function getBathrooms(): ?int
    {
        return $this->bathrooms;
    }

    public function setBathrooms(int $bathrooms): static
    {
        $this->bathrooms = $bathrooms;

        return $this;
    }

    public function isParking(): ?bool
    {
        return $this->parking;
    }

    public function setParking(bool $parking): static
    {
        $this->parking = $parking;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function isFurnished(): ?bool
    {
        return $this->furnished;
    }

    public function setFurnished(bool $furnished): static
    {
        $this->furnished = $furnished;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getRegularPrice(): ?int
    {
        return $this->regularPrice;
    }

    public function setRegularPrice(int $regularPrice): static
    {
        $this->regularPrice = $regularPrice;

        return $this;
    }

    public function getDiscountedPrice(): ?int
    {
        return $this->discountedPrice;
    }

    public function setDiscountedPrice(?int $discountedPrice): static
    {
        $this->discountedPrice = $discountedPrice;

        return $this;
    }

    public function getLatitude(): ?int
    {
        return $this->latitude;
    }

    public function setLatitude(int $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?int
    {
        return $this->longitude;
    }

    public function setLongitude(int $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): static
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return Collection<int, ListingImage>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(ListingImage $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setListing($this);
        }

        return $this;
    }

    public function removeImage(ListingImage $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getListing() === $this) {
                $image->setListing(null);
            }
        }

        return $this;
    }
}
