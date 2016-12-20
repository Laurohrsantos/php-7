<?php

namespace CodeEmailMKT\Application\Action\Tag\Factory;

use CodeEmailMKT\Application\Action\Tag\TagCreatePageAction;
use CodeEmailMKT\Application\Form\TagForm;
use CodeEmailMKT\Domain\Persistence\TagRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class TagCreatePageFactory
{
    public function __invoke(ContainerInterface $container) : TagCreatePageAction
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(TagRepositoryInterface::class);
        $route = $container->get(RouterInterface::class);
        $form = $container->get(TagForm::class);

        return new TagCreatePageAction($repository, $template, $route, $form);
    }
}
