<?php

namespace CodeEmailMKT\Application\Form\Factory;

use CodeEmailMKT\Application\Form\CustomerForm;
use CodeEmailMKT\Application\InputFilter\CustomerInputFilter;
use CodeEmailMKT\Domain\Entity\Customer;
use Zend\Hydrator\ClassMethods;

class CustomerFormFactory
{
    public function __invoke()
    {
        $form = new CustomerForm();

        $form->setHydrator(new ClassMethods());
        $form->setObject(new Customer());

        $form->setInputFilter(new CustomerInputFilter()); //Usando o input filter que foi criado na aplicação

        return $form;
    }
}