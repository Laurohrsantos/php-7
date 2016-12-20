<?php

namespace CodeEmailMKT\Application\Action\Tag\Factory;

use CodeEmailMKT\Application\Action\Tag\TagDeletePageAction;
use CodeEmailMKT\Application\Form\TagForm;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use CodeEmailMKT\Domain\Persistence\TagRepositoryInterface;

class TagDeletePageFactory
{
    public function __invoke(ContainerInterface $container) : TagDeletePageAction
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(TagRepositoryInterface::class);
        $route = $container->get(RouterInterface::class);
        $form = $container->get(TagForm::class);

        return new TagDeletePageAction($repository, $template, $route, $form);
    }
}
