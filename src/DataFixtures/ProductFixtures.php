<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public const PRODUCTS = [
        [
            'id' => 'disinfectant',
            'name' => 'Andarta 33-455-A Super Professional Antiviral Disinfectant 750ml',
            'description' => <<<EOD
This Super Antiviral Disinfectant's powerful formulation kills a range of pathogenic viruses in under 5 minutes.
Its safe formula is suitable for use on most non-porous surfaces and when used as directed, leaves treated surfaces safe for human contact.

    Effective against Coronavirus
    Kills 99.99% of germs and viruses
    Cleans and disinfects
    Ready to use
    Contains Alkyl (C12-16) dimethylbenzyl ammonium chloride (ADBAC/BKC (C12-16)) 0.125g/100g
    Supplied in a 750ml trigger spray bottle
EOD,
            'image' => 'https://cdn.manomano.com/images/images_products/8410544/L/18969568_1.jpg',
            'price' => 7.32,
        ],
        [
            'name' => '2 x 5L Spear & Jackson Spray and Leave Concentrated Algae, Lichen and Mould remover',
            'description' => <<<EOD
One 5lt bottle makes 25lts of product! Covers 100-250m2 depending on the surface Designed for use on patios, roofs, fencing, upvc windows, sheds, caravans,boats, decking and driveways Premium UK Manufactured Brand - Removes algae, green mould, and lichen Helps prevent re-growth see results that last for months Spear & Jackson Spay & Leave is a premium quality formulation that will keep on working for many months due to it's strong cleaning power, results will be visible in a few days and will keep improving over time. Spear & Jackson's products have become widely recognised for their heritage and high quality so you can rest assured that buying British is buying the Best ! NOTE: The colour of the bottle may vary NOTE: The colour of the bottle may vary
EOD,
            'image' => 'https://cdn.manomano.com/images/images_products/21084419/L/40760395_1.jpg',
            'price' => 29.99,
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PRODUCTS as $key => $data) {
            unset($id);
            extract($data);

            $product = (new Product())
                ->setName($name)
                ->setDescription($description)
                ->setImage($image)
                ->setPrice($price)
            ;
            $manager->persist($product);
            $this->addReference('product_' . ($id ?? $key), $product);
        }
        $manager->flush();
    }
}
