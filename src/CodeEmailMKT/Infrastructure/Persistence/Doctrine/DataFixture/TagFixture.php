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

        foreach (range(1, 100) as $key => $value) {
            $tag = new Tag();
            $tag->setName($faker->city);
            $this->addCustomers($tag);

            $manager->persist($tag);
        }

        $manager->flush();
    }

    public function addCustomers(Tag $tag)
    {
        $numCustomers = rand(1, 5);
        foreach (range(1, $numCustomers) as $value) {

            $index = rand(0, 99);
            $customer = $this->getReference("customer-$index");

            if ($tag->getCustomers()->exists(function ($key, $item) use ($customer) {
                return $customer->getId() == $item->getId();
            })
            ) {
                $index = rand(0, 99);
                $customer = $this->getReference("customer-$index");
            }

            $tag->getCustomers()->add($customer);
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
