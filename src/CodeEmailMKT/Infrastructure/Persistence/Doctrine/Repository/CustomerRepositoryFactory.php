<?php

namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository;

use CodeEmailMKT\Domain\Entity\Customer;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

class CustomerRepositoryFactory
{

    public function __invoke(ContainerInterface $container) : CustomerRepository
    {
        /** @var EntityManager $entityManager */
        $entityManager = $container->get(EntityManager::class);
        return $entityManager->getRepository(Customer::class);
    }
}
