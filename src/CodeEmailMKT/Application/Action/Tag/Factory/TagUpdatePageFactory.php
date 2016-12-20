<?php

namespace CodeEmailMKT\Application\Action\Tag\Factory;

use CodeEmailMKT\Application\Action\Tag\TagUpdatePageAction;
use CodeEmailMKT\Application\Form\TagForm;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use CodeEmailMKT\Domain\Persistence\TagRepositoryInterface;

class TagUpdatePageFactory
{
    public function __invoke(ContainerInterface $container) : TagUpdatePageAction
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(TagRepositoryInterface::class);
        $route = $container->get(RouterInterface::class);
        $form = $container->get(TagForm::class);

        return new TagUpdatePageAction($repository, $template, $route, $form);
    }
}
