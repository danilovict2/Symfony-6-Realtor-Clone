<?php

namespace App\Controller;

use App\Entity\Listing;
use App\Repository\ListingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[IsGranted("ROLE_USER")]
#[Route('/listing')]
class ListingController extends AbstractController
{
    public function __construct(private ListingRepository $listingRepository)
    {
    }

    #[Route('/create', name: 'listing_create')]
    public function create(): Response
    {
        return $this->render('listing/create.html.twig');
    }

    #[Route('/store', name: 'listing_store', methods: ["POST"])]
    public function store(Request $request, ValidatorInterface $validator, EntityManagerInterface $entityManager): Response
    {
        $data = $this->formatData($request->request->all());
        $listing = $this->listingRepository->createListing($data, $request->files->get('images'));

        $errors = $validator->validate($listing);
        if ($errors->count() > 0) {
            return new Response(json_encode(['error' => $errors[0]->getMessage()]), 400);
        }

        $listing->setCreatedBy($this->getUser());
        $entityManager->persist($listing);
        if ($data['id']) {
            $entityManager->remove($this->listingRepository->find($data['id']));
        }
        $entityManager->flush();
        return new Response(json_encode(['id' => $listing->getId()]));
    }

    private function formatData(array $data): array
    {
        $data['id'] = $data['id'] !== 'null' ? (int)$data['id'] : null;
        $data['parking'] = $data['parking'] === 'true';
        $data['furnished'] = $data['furnished'] === 'true';
        $data['discountedPrice'] = $data['discountedPrice'] !== 'null' ? (int)$data['discountedPrice'] : null;
        return $data;
    }

    #[Route('/edit/{listing}', name: 'listing_edit')]
    public function edit(Listing $listing): Response
    {
        if ($listing->getCreatedBy() !== $this->getUser()) {
            return new Response("You aren't allowed to edit this listing!", 403);
        }

        return $this->render('listing/edit.html.twig', [
            'listing' => $listing
        ]);
    }
    
    #[Route('/delete/{listing}', name: 'listing_delete', methods: ["POST"])]
    public function delete(Listing $listing, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($listing);
        $entityManager->flush();
        return $this->redirectToRoute('profile');
    }
    
    #[Route('/api/fetch/{offset}', name: 'listings_fetch')]
    public function fetchListings(int $offset, ListingRepository $listingRepository): Response
    {
        $listings = $listingRepository->findBy([], ['createdAt' => 'DESC'], ListingRepository::FETCH_LIMIT + $offset);
        $listings = array_map(fn($listing) => $listing->toArray(), $listings);
        return new Response(json_encode(['listings' => $listings]));
    }

    #[Route('/{category}/{listing}', name: 'listing_show')]
    public function show(string $category, Listing $listing): Response
    {
        if ($listing->getCreatedBy() !== $this->getUser() || $listing->getType() !== $category) {
            return new Response("You aren't allowed to view this listing!", 403);
        }

        return $this->render('listing/show.html.twig', [
            'listing' => $listing
        ]);
    }
}
