<?php

namespace App\DataFixtures;

use App\Entity\WishList;
use App\Entity\WishListProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class WishListFixtures extends Fixture implements DependentFixtureInterface
{
    public const WISHLISTS = [
        [
            'name' => 'a lot of disinfectant',
            'products' => [
                [
                    'product' => 'product_disinfectant',
                    'quantity' => 10000,
                ],
            ],
        ],
        [
            'name' => 'some disinfectant',
            'products' => [
                [
                    'product' => 'product_disinfectant',
                    'quantity' => 200,
                ],
            ],
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $user = $this->getReference('user');

        foreach (self::WISHLISTS as $key => $wishListData) {
            extract($wishListData);
            $wishList = (new WishList)
                ->setUser($user)
                ->setName($name)
            ;

            foreach ($products as $productData) {
                extract($productData);
                $wishListProduct = (new WishListProduct)
                    ->setProduct($this->getReference($product))
                    ->setQuantity($quantity)
                ;
                $wishList->addWishListProduct($wishListProduct);
                $manager->persist($wishListProduct);
            }

            $manager->persist($wishList);
            $this->addReference('wishlist_' . $key, $wishList);
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
