<?php

namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\DataFixture;

use CodeEmailMKT\Domain\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as Faker;

class UserFixture implements FixtureInterface
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

        $user = new User();
        $user->setName('Administrador');
        $user->setEmail('admin@user.com');
        $user->setPlainPassword(123456);

        $manager->persist($user);

        foreach (range(1, 10) as $value) {
            $user = new User();
            $user->setName($faker->firstName . ' ' . $faker->lastName);
            $user->setEmail($faker->email);
            $user->setPlainPassword(123456);

            $manager->persist($user);
        }

        $manager->flush();
    }
}