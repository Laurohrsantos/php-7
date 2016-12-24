<?php

namespace CodeEmailMKT\Application\Action\Campaign\Factory;

use CodeEmailMKT\Application\Action\Campaign\CampaignListPageAction;
use Interop\Container\ContainerInterface;
use Mailgun\Mailgun;
use Zend\Expressive\Template\TemplateRendererInterface;
use CodeEmailMKT\Domain\Persistence\CampaignRepositoryInterface;

class CampaignListPageFactory
{
    public function __invoke(ContainerInterface $container) : CampaignListPageAction
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(CampaignRepositoryInterface::class);
        $mailgun = $container->get(Mailgun::class);

        return new CampaignListPageAction($repository, $template, $mailgun);
    }
}
