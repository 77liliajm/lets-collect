<?php

namespace App\Controller;

use App\Repository\WishlistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class WishlistController extends AbstractController
{
    #[Route('/wishlist', name: 'app_wishlist')]
    public function index(WishlistRepository $wishlistRepo): Response
    {
        $user = $this->getUser();

        $items = $wishlistRepo->findByUserGrouped($user);

        return $this->render('wishlist/index.html.twig', [
            'items' => $items,
        ]);
    }
}
