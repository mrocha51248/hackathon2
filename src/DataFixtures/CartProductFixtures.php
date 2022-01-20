<?php

namespace App\DataFixtures;

use App\Entity\CartProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CartProductFixtures extends Fixture implements DependentFixtureInterface
{
    public const PRODUCTS = [
        [
            'product' => 'product_disinfectant',
            'quantity' => 150,
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $user = $this->getReference('user');

        foreach (self::PRODUCTS as $productData) {
            extract($productData);
            $cartProduct = (new CartProduct)
                ->setProduct($this->getReference($product))
                ->setQuantity($quantity)
            ;
            $user->addCartProduct($cartProduct);
            $manager->persist($cartProduct);
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
