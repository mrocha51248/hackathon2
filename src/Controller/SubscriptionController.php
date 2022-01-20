<?php

namespace App\Controller;


use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/subscription')]

class SubscriptionController extends AbstractController
{
    #[Route('/', name: 'subscription')]
    public function index(SubscriptionRepository $subscriptionRepository): Response
    {
        $subscriptions = $subscriptionRepository->findAll();
        return $this->render('subscription/index.html.twig', [
            'subscriptions' => $subscriptions,
        ]);
    }

    #[Route('/new', name: 'new_subscription')]
    public function new(ProductRepository $productRepository): Response
    {
        return $this->render('subscription/new.html.twig', ['products' => $productRepository->findBy([], ['name' => 'DESC'], 3)]);
    }
}
