<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/subscription')]

class SubscriptionController extends AbstractController
{
    #[Route('/', name: 'subscription')]
    public function index(): Response
    {
        return $this->render('subscription/index.html.twig', [
            'controller_name' => 'SubscriptionController',
        ]);
    }

    #[Route('/new', name: 'new_subscription')]
    public function new(ProductRepository $productRepository): Response
    {
        return $this->render('subscription/new.html.twig', ['products' => $productRepository->findBy([], ['name' => 'DESC'], 3)]);
    }
}
