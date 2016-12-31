<?php

namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\Fixture;

use CodeEmailMKT\Domain\Entity\Tag;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as Faker;

class TagFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $key => $value) {
            $tag = new Tag();
            $tag->setName($faker->city);
            $this->addCustomers($tag);
            $this->addCampaigns($tag);

            $manager->persist($tag);
        }

        $manager->flush();
    }

    public function addCustomers(Tag $tag)
    {
        $indexCustomers = array_rand(range(0, 3), rand(2, 4));

        foreach ($indexCustomers as $value) {
            $customer = $this->getReference("customer-{$value}");
            $tag->getCustomers()->add($customer);
        }
    }

    public function addCampaigns(Tag $tag)
    {
        $indexCampaigns = array_rand(range(0, 19), rand(2, 5));

        foreach ($indexCampaigns as $value) {
            $campaign = $this->getReference("campaign-{$value}");

            if ($campaign->getTags()->count() < 2) {
                $campaign->getTags()->add($tag);
                $tag->getCampaigns()->add($campaign);
            }
        }
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 200;
    }
}
