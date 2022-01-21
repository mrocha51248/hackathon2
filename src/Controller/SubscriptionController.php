<?php

namespace App\Controller;

use App\Entity\Subscription;
use App\Entity\SubscriptionProduct;
use App\Entity\WishList;
use App\Repository\SubscriptionRepository;
use DateInterval;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/new_from_list/{id}', name: 'new_subscription_from_list')]
    public function newFromList(WishList $wishList, EntityManagerInterface $entityManager, Request $request): Response
    {
        $period = $request->query->get('products');
        $subscription = (new Subscription)
            ->setName($wishList->getName())
            ->setNextDelivery(new DateTime())
            ->setPeriod(new DateInterval($period))
            ->setUser($wishList->getUser())
        ;
        foreach ($wishList->getWishListProducts() as $product) {
            $subscriptionProduct = (new SubscriptionProduct)
                ->setPrice($product->getProduct()->getPrice())
                ->setProduct($product->getProduct())
                ->setQuantity($product->getQuantity())
            ;
            $subscription->addSubscriptionProduct($subscriptionProduct);
            $entityManager->persist($subscriptionProduct);
        }
        $entityManager->persist($subscription);
        $entityManager->flush();
        return $this->redirectToRoute('subscription');
    }
}
