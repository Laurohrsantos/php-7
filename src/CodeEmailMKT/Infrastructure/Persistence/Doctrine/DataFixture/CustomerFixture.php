<?php

namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\DataFixture;

use CodeEmailMKT\Domain\Entity\Customer;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as Faker;

class CustomerFixture implements FixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //inicia a instancia do faker
        $faker = Faker::create();

        foreach (range(1, 100) as $value) {
            $customer = new Customer();
            $customer->setName($faker->firstName . ' ' . $faker->lastName);
            $customer->setEmail($faker->email);

            $manager->persist($customer);
        }

        $manager->flush();
    }
}