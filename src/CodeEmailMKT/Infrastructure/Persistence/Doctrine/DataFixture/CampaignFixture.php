<?php

namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\Fixture;

use CodeEmailMKT\Domain\Entity\Campaign;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as Faker;

class CampaignFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $key => $value) {
            $campaign = new Campaign();
            $campaign->setName($faker->country);
            $campaign->setTemplate("");

            $manager->persist($campaign);

            $this->addReference("campaign-$key", $campaign);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 100;
    }
}
