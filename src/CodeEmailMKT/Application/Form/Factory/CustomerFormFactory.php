<?php

namespace CodeEmailMKT\Application\Form\Factory;

use CodeEmailMKT\Application\Form\CustomerForm;
use CodeEmailMKT\Application\InputFilter\CustomerInputFilter;
use CodeEmailMKT\Domain\Entity\Customer;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Interop\Container\ContainerInterface;

class CustomerFormFactory
{
    public function __invoke(ContainerInterface $container) : CustomerForm
    {
        $entityManager = $container->get(EntityManager::class);

        $form = new CustomerForm();
        $form->setHydrator(new DoctrineHydrator($entityManager));
        $form->setObject(new Customer());

        $form->setInputFilter(new CustomerInputFilter()); //Usando o input filter que foi criado na aplicação
        $form->setObjectManager($entityManager);
        $form->init();

        return $form;
    }
}