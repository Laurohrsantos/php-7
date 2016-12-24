<?php

namespace CodeEmailMKT\Application\Action\Campaign\Factory;

use CodeEmailMKT\Application\Action\Campaign\CampaignDeletePageAction;
use CodeEmailMKT\Application\Form\CampaignForm;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use CodeEmailMKT\Domain\Persistence\CampaignRepositoryInterface;

class CampaignDeletePageFactory
{
    public function __invoke(ContainerInterface $container): CampaignDeletePageAction
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(CampaignRepositoryInterface::class);
        $route = $container->get(RouterInterface::class);
        $form = $container->get(CampaignForm::class);

        return new CampaignDeletePageAction($repository, $template, $route, $form);
    }
}