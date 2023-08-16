<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[IsGranted("ROLE_USER")]
#[Route('/profile')]
class ProfileController extends AbstractController
{
    #[Route('', name: 'profile')]
    public function show(): Response
    {
        return $this->render('profile/show.html.twig', [
            'user' => $this->getUser(),
            'listings' => $this->getUser()->getListings()
        ]);
    }

    #[Route('/update', name: 'profile_update', methods: ["POST"])]
    public function update(Request $request, ValidatorInterface $validator, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $currentName = $user->getName();
        $user->setName($request->query->getString('name'));

        $errors = $validator->validate($user);
        if ($errors->count() > 0) {
            return new Response(json_encode(['name' => $currentName, 'error' => $errors[0]->getMessage()]), 400);
        }

        $entityManager->persist($user);
        $entityManager->flush();
        return new Response();
    }
}
