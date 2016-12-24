<?php

namespace CodeEmailMKT\Application\Action\Campaign;

use CodeEmailMKT\Application\Form\CampaignForm;
use CodeEmailMKT\Domain\Service\CampaignEmailSenderInterface;
use CodeEmailMKT\Domain\Service\CampaignReportInterface;
use CodeEmailMKT\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;
use CodeEmailMKT\Domain\Persistence\CampaignRepositoryInterface;

class CampaignReportPageAction
{
    /**
     * @var CampaignRepositoryInterface
     */
    private $repository;
    /**
     * @var CampaignReportInterface
     */
    private $report;

    public function __construct(
        CampaignRepositoryInterface $repository,
        CampaignReportInterface $report
    ) {
        $this->repository = $repository;
        $this->report = $report;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $id = $request->getAttribute('id');
        $entity = $this->repository->find($id);
        $this->report->setCampaign($entity);

        return $this->report->render();
    }
}
