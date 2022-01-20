<?php

namespace App\Controller;

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
    public function new(): Response
    {
        return $this->render('subscription/new.html.twig');
    }
}
