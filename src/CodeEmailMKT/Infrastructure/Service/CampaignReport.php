<?php

declare(strict_types = 1);

namespace CodeEmailMKT\Infrastructure\Service;

use CodeEmailMKT\Domain\Entity\Campaign;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;
use CodeEmailMKT\Domain\Service\CampaignReportInterface;
use Mailgun\Connection\Exceptions\MissingEndpoint;
use Mailgun\Mailgun;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

class CampaignReport implements CampaignReportInterface
{

    /**
     * @var Campaign
     */
    private $campaign;
    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;
    /**
     * @var array
     */
    private $mailGun;
    /**
     * @var array
     */
    private $mailGunConfig;
    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;

    /**
     * CampaignEmailSender constructor.
     * @param $campaign
     */
    public function __construct(
        TemplateRendererInterface $templateRenderer,
        Mailgun $mailGun,
        array $mailGunConfig,
        CustomerRepositoryInterface $repository
    )
    {

        $this->templateRenderer = $templateRenderer;
        $this->mailGun = $mailGun;
        $this->mailGunConfig = $mailGunConfig;
        $this->repository = $repository;
    }


    public function setCampaign(Campaign $campaign): CampaignReport
    {
        $this->campaign = $campaign;
        return $this;
    }

    public function render(): ResponseInterface
    {
        $domain = $this->mailGunConfig['domain'];

        try {
            return new HtmlResponse($this->templateRenderer->render('app::campaign/report', [
                'campaign_data' => $this->getCampaignData(),
                'campaign' => $this->campaign,
                'customers_count' => $this->getCountCustomers(),
                'opened_distinct_count' => $this->getCountOpenedDistinct()
            ]));
        } catch (MissingEndpoint $ex) {
            return new HtmlResponse($this->templateRenderer->render('app::campaign/report_error', [
                'campaign' => $this->campaign
            ]));
        }
    }

    protected function getCampaignData()
    {
        $domain = $this->mailGunConfig['domain'];
        $response = $this->mailGun->get("$domain/campaigns/campaign_{$this->campaign->getId()}");

        return $response->http_response_body;
    }

    protected function getCountOpenedDistinct()
    {
        $domain = $this->mailGunConfig['domain'];
        $response = $this->mailGun->get("$domain/campaigns/campaign_{$this->campaign->getId()}/opens", [
            'groupby' => 'recipient',
            'count' => true
        ]);

        return $response->http_response_body->count;
    }

    protected function getCountCustomers()
    {
        $tags = $this->campaign->getTags()->toArray();
        $customers = $this->repository->finByTag($tags);

        return count($customers);
    }

}