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
            'id' => 'screwdriver_bits',
            'name' => '94PC 1/2" & 1/4" SOCKET SET & SCREWDRIVER BITS TOOL TORX IN CASE RATCHET KIT NEW',
            'description' => <<<EOD
94PC 1/2" & 1/4" SOCKET SET & SCREWDRIVER BITS
1/4 inch dr
13 Metric Flank Drive sockets (6pt):
4mm, 4.5mm, 5.5mm, 5mm, 6mm, 7mm, 8mm, 9mm, 10mm, 11mm, 12mm, 13mm, 14mm
8 Metric Flank Drive Deep sockets (6pt):
6mm, 7mm, 8mm, 10mm, 11mm, 12mm, 13mm
17 inserted bits sockets: 3 Regular type: 4,5.5,7mm
4-hex type: 3,4,5,6mm
2-PHillips Nr: 1,2 2-Pozi Dr.
1,2 6-Torx Nr.: T8,T10,T15,T20,T25,T30
8 Accessories: Flexible Extension: 150mm, Sliding T-bar, Universal Joint,
1/4 inch Dr. Square by hex adaptor, extension bars 50mm, 100mm extension bar 6 inch with spanner handle
1/2 inch dr
18 Metric Flank Drive sockets:
10,11,12,13,14,15,16,17, 18,19,20,21, 22,23,24,27,30,32mm
4 Metric Flank Drive Deep sockets: 14,15,17,19mm
EOD,
            'image' => 'https://cdn.manomano.com/images/images_products/9578772/L/32531015_1.jpg',
            'price' => 27.49,
        ],
        [
            'id' => 'smoke_alarm',
            'name' => '10 Year Wireless Smoke Alarm Interlinked Radio-Link Smoke Detector with Flash',
            'description' => <<<EOD
RF433mhz Wireless Interconnected, 85dB sound alarm
Built-in DC3V Lithium battery, 10-year battery life
Large Test and Silence Button
CE EN14604/AS3786ROSH Listed
Connect up to 50 compatible interconnected smoke alarms
Compliant with New Scottish Legislation 2020, EN:14604
EOD,
            'image' => 'https://cdn.manomano.com/images/images_products/12840388/L/41867518_1.jpg',
            'price' => 28.99,
        ],
        [
            'id' => 'batteries',
            'name' => 'DeWalt DCB184 18V XR 5.0Ah Li-Ion Batteries (Twin Pack)',
            'description' => <<<EOD
Features:The new DeWalt 5.0Ah XR Li-Ion battery packs will deliver 66% more runtime than a standard 3.0Ah battery packLED State of Charge Indicator helps manage pack chargingLightweight design provides the user with upgraded 5Ah Power without increasing the size or weight over the 18V 3Ah battery packNo memory effect and virtually no self-discharge for maximum productivity & less downtimeCompatible with all DeWalt XR Li-Ion 18V ToolsProtection against overheat, overload and deep discharge conditions increases battery lifeExcellent electrical characteristicsNo memory effectPack of 2Specification:Battery Capacity: 5.0 AhVoltage: 18VHeight: 65mmLength: 110mmWeight: 0.62kgCompatible with: All 18V XR Li-Ion DeWalt tools
EOD,
            'image' => 'https://cdn.manomano.com/images/images_products/5948112/L/11175942_1.jpg',
            'price' => 116.99,
        ],
        [
            'id' => 'oil',
            'name' => '101 Multi-Purpose Linseed Oil Putty Brown 500g EVBMPPB05',
            'description' => <<<EOD
Everbuild 101 Multi-Purpose Linseed Oil Putty is a hand applied setting glazing compound for sealing glass into metal and wooden frames.
Benefits:
- Easier to apply than most competitive putties.
- Extended shelf life.
- For wood and metal frames.
- Added plasticiser improves adhesion and helps prevent cracking.
- Single glazing of pretreated wooden and metal rebates.
EOD,
            'image' => 'https://cdn.manomano.com/images/images_products/7840040/L/14461909_1.jpg',
            'price' => 6.14,
        ],
        [
            'id' => 'nails',
            'name' => 'Everbuild Gun A Nail Extra Strength Quick Grab Panel Adhesive C3 Size Pack of 6',
            'description' => <<<EOD
EVERBUILD GUN A NAIL EXTRA is a ready to use gap filling and panel adhesive based on a high bond strength synthetic rubber/resin mix in a solvent carrier. Adheres to most common surfaces inside and outside the home. Bonds to wood, plaster, plasterboard, carpet, carpet grippers, metal, glass, ceramics, brick, concrete, cork, uPVC and certain plastics.
EOD,
            'image' => 'https://cdn.manomano.com/images/images_products/10264286/L/28960667_1.jpg',
            'price' => 15.99,
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
