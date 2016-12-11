<?php

namespace CodeEmailMKT\Application\Action\Customer\Factory;

use CodeEmailMKT\Application\Action\Customer\CustomerUpdatePageAction;
use CodeEmailMKT\Application\Form\CustomerForm;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;

class CustomerUpdatePageFactory
{
    public function __invoke(ContainerInterface $container) : CustomerUpdatePageAction
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(CustomerRepositoryInterface::class);
        $route = $container->get(RouterInterface::class);
        $form = $container->get(CustomerForm::class);

        return new CustomerUpdatePageAction($repository, $template, $route, $form);
    }
}
