<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\OrderProduct;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    public const ORDERS = [
        [
            'orderedAt' => '2010/09/09',
            'products' => [
                [
                    'product' => 'product_disinfectant',
                    'quantity' => 10,
                    'price' => 5.12,
                ],
                [
                    'product' => 'product_oil',
                    'quantity' => 5,
                    'price' => 1.02,
                ],
            ],
        ],
        [
            'orderedAt' => '2015/06/06',
            'products' => [
                [
                    'product' => 'product_smoke_alarm',
                    'quantity' => 30,
                    'price' => 17.23,
                ],
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

        foreach (self::ORDERS as $key => $orderData) {
            extract($orderData);
            $order = (new Order)
                ->setUser($user)
                ->setOrderedAt(new DateTimeImmutable($orderedAt))
            ;

            foreach ($products as $productData) {
                extract($productData);
                $orderProduct = (new OrderProduct)
                    ->setProduct($this->getReference($product))
                    ->setQuantity($quantity)
                    ->setPrice($price)
                ;
                $order->addOrderProduct($orderProduct);
                $manager->persist($orderProduct);
            }

            $manager->persist($order);
            $this->addReference('order_' . $key, $order);
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
