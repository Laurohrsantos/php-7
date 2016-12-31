<?php

namespace CodeEmailMKT\Infrastructure\Service;

use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use Interop\Container\ContainerInterface;
use Mailgun\Mailgun;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampaignReportFactory
{
    public function __invoke(ContainerInterface $container) : CampaignReport
    {
        $template = $container->get(TemplateRendererInterface::class);
        $mailGun = $container->get(Mailgun::class);
        $mailGunConfig = $container->get('config')['mailgun'];
        $repository = $container->get(CustomerRepositoryInterface::class);

        return new CampaignReport($template, $mailGun, $mailGunConfig, $repository);
    }
}