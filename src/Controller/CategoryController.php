<?php

namespace App\Controller;

use App\Repository\ListingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category')]
class CategoryController extends AbstractController
{
    #[Route('/{category}', name: 'category_index')]
    public function index(string $category): Response
    {
        if (!in_array($category, ListingRepository::LISTING_TYPES)) {
            return new Response("Invalid category!", 403);
        }

        return $this->render('category/index.html.twig', [
            'category' => $category
        ]);
    }
}
