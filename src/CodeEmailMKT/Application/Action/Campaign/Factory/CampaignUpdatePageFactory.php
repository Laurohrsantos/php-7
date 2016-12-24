<?php

namespace CodeEmailMKT\Application\Action\Campaign\Factory;

use CodeEmailMKT\Application\Action\Campaign\CampaignUpdatePageAction;
use CodeEmailMKT\Application\Form\CampaignForm;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use CodeEmailMKT\Domain\Persistence\CampaignRepositoryInterface;

class CampaignUpdatePageFactory
{
    public function __invoke(ContainerInterface $container) : CampaignUpdatePageAction
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(CampaignRepositoryInterface::class);
        $route = $container->get(RouterInterface::class);
        $form = $container->get(CampaignForm::class);

        return new CampaignUpdatePageAction($repository, $template, $route, $form);
    }
}
