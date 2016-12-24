<?php

namespace CodeEmailMKT\Application\Action\Campaign;

use CodeEmailMKT\Application\Form\CampaignForm;
use CodeEmailMKT\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;
use CodeEmailMKT\Domain\Persistence\CampaignRepositoryInterface;

class CampaignCreatePageAction
{
    private $template;

    /**
     * @var CampaignRepositoryInterface
     */
    private $repository;

    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var CampaignForm
     */
    private $form;

    public function __construct(
        CampaignRepositoryInterface $repository,
        Template\TemplateRendererInterface $template,
        RouterInterface $router,
        CampaignForm $form
    )
    {
        $this->template = $template;
        $this->repository = $repository;
        $this->router = $router;
        $this->form = $form;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        if ($request->getMethod() == 'POST') {
            $flash = $request->getAttribute('flash');

            $dataRaw = $request->getParsedBody();
            $this->form->setData($dataRaw);

            if ($this->form->isValid()) {
                $entity = $this->form->getData();
                $this->repository->create($entity);

                $flash->setMessage(FlashMessageInterface::MESSAGE_SUCCESS, "Campanha cadastrada!");

                $uri = $this->router->generateUri('campaign.list');

                return new RedirectResponse($uri);
            }

        }

        return new HtmlResponse($this->template->render('app::campaign/create', [
            'form' => $this->form
        ]));
    }
}
