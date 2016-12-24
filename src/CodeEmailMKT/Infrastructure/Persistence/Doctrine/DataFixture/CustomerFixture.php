<?php

namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\DataFixture;

use CodeEmailMKT\Domain\Entity\Customer;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as Faker;

class CustomerFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        //inicia a instancia do faker
//        $faker = Faker::create();

        foreach ($this->getData() as $key => $value) {
            $customer = new Customer();
            $customer->setName($value['name']);
            $customer->setEmail($value['email']);

            $manager->persist($customer);

            $this->addReference("customer-$key", $customer);
        }

        $manager->flush();
    }

    public function getData ()
    {
        return [
            ['name' => 'Henrique Yahoo', 'email' => 'henrique_rodrigues_s@yahoo.com.br'],
            ['name' => 'Lauro Hotmail', 'email' => 'lauro.hrsantos@hotmail.com'],
            ['name' => 'Henrique hotmail', 'email' => 'henrique_1583@hotmail.com'],
            ['name' => 'Henrique hotmail2', 'email' => 'henrique_1583@hotmail.com'],
            ['name' => 'Henrique Apoio', 'email' => 'henrique@apoiodesenvolvimento.com.br'],
        ];
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