<?php

namespace App\DataFixtures;

use App\Entity\Expertise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExpertiseFixtures extends Fixture
{
    public const JOBS = [
        'Construction',
        'Industry',
        'Farming',
        'Mechanics',
        'Sector',
        'Sales',
        'Industry',
        'Services',
        'Other',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::JOBS as $key => $jobName) {
            $job = (new Expertise())
                ->setName($jobName);
            $manager->persist($job);
            $this->addReference('job_' . $key, $job);
        }
        $manager->flush();
    }
}
