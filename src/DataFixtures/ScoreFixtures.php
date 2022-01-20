<?php

namespace App\DataFixtures;

use App\Entity\Score;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ScoreFixtures extends Fixture implements DependentFixtureInterface
{
    public const SCORES = [
        [
            'job' => 'job_0',
            'product' => 'product_disinfectant',
            'score' => 3,
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SCORES as $key => $data) {
            extract($data);
            $score = (new Score())
                ->setJob($this->getReference($job))
                ->setProduct($this->getReference($product))
                ->setScore($score)
            ;
            $manager->persist($score);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ExpertiseFixtures::class,
            ProductFixtures::class,
        ];
    }
}
