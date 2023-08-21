<?php

namespace App\Controller;

use App\Repository\ListingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(ListingRepository $listingRepository): Response
    {
        $recentListings = array_map(fn($listing) => $listing->toArray(), $listingRepository->getRecentListings());
        $offerListings = $listingRepository->getRecentListingsWithOffer();
        $rentListings = $listingRepository->getRecentListingsOfType('rent');
        $saleListings = $listingRepository->getRecentListingsOfType('sale');
        return $this->render('pages/index.html.twig', [
            'recentListings' => $recentListings,
            'offerListings' => $offerListings,
            'rentListings' => $rentListings,
            'saleListings' => $saleListings,
        ]);
    }
}
