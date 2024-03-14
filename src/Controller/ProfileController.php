<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ProfileController extends AbstractController
{
    #[Route('/u/{username}', name: 'profile')]
    public function index(User $user, NormalizerInterface $normalizer): Response
    {
        return $this->render('profile/index.html.twig', [
            'user' => $normalizer->normalize($user),
            'authUser' => $normalizer->normalize($this->getUser())
        ]);
    }
}
