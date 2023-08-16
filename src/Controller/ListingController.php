<?php

namespace App\Controller;

use App\Repository\ListingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[IsGranted("ROLE_USER")]
class ListingController extends AbstractController
{
    public function __construct(private ListingRepository $listingRepository)
    {
    }

    #[Route('/listing/create', name: 'listing_create')]
    public function create(): Response
    {
        return $this->render('listing/create.html.twig');
    }

    #[Route('/listing/store', name: 'listing_store', methods: ["POST"])]
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
        $entityManager->flush();
        return new Response(json_encode(['id' => $listing->getId()]));
    }

    private function formatData(array $data): array
    {
        $data['parking'] = $data['parking'] === 'true';
        $data['furnished'] = $data['furnished'] === 'true';
        $data['discountedPrice'] = $data['discountedPrice'] !== 'null' ? (int)$data['discountedPrice'] : null;
        return $data;
    }
}
