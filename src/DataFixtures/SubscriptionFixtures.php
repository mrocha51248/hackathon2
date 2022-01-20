<?php

namespace App\DataFixtures;

use App\Entity\Subscription;
use App\Entity\SubscriptionProduct;
use DateInterval;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SubscriptionFixtures extends Fixture implements DependentFixtureInterface
{
    public const SUBSCRIPTIONS = [
        [
            'name' => 'long term plan',
            'nextDelivery' => '2030/09/09',
            'period' => 'P10Y',
            'products' => [
                [
                    'product' => 'product_disinfectant',
                    'quantity' => 10000,
                    'price' => 1.12,
                ],
            ],
        ],
        [
            'name' => 'yearly supplies',
            'nextDelivery' => '2022/06/06',
            'period' => 'P1Y',
            'products' => [
                [
                    'product' => 'product_disinfectant',
                    'quantity' => 200,
                    'price' => 7.23,
                ],
            ],
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $user = $this->getReference('user');

        foreach (self::SUBSCRIPTIONS as $key => $subscriptionData) {
            extract($subscriptionData);
            $subscription = (new Subscription)
                ->setUser($user)
                ->setName($name)
                ->setNextDelivery(new DateTime($nextDelivery))
                ->setPeriod(new DateInterval($period))
            ;

            foreach ($products as $productData) {
                extract($productData);
                $subscriptionProduct = (new SubscriptionProduct)
                    ->setProduct($this->getReference($product))
                    ->setQuantity($quantity)
                    ->setPrice($price)
                ;
                $subscription->addSubscriptionProduct($subscriptionProduct);
                $manager->persist($subscriptionProduct);
            }

            $manager->persist($subscription);
            $this->addReference('subscription_' . $key, $subscription);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProductFixtures::class,
            UserFixtures::class,
        ];
    }
}
