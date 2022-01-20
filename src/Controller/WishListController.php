<?php

namespace App\Controller;

use App\Repository\WishListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishListController extends AbstractController
{
    #[Route('/wishlist', name: 'wishlist')]
    public function index(WishListRepository $wishListRepository): Response
    {
        $wishLists = $wishListRepository->findAll();
        return $this->render('wishlist/index.html.twig', [
            'wishlists' => $wishLists,
        ]);
    }
}
