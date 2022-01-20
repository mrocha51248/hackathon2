<?php

namespace App\Controller;

use App\Entity\CartProduct;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CartProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart')]
    public function index(CartProductRepository $cartProductRepository): Response
    {   
        return $this->render('cart/index.html.twig', [
            'carts' => $cartProductRepository->findAll(),
        ]);
    }
}
