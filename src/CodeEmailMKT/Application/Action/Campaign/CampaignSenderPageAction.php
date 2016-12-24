<?php

namespace CodeEmailMKT\Application\Action\Campaign;

use CodeEmailMKT\Application\Form\CampaignForm;
use CodeEmailMKT\Domain\Service\CampaignEmailSenderInterface;
use CodeEmailMKT\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;
use CodeEmailMKT\Domain\Persistence\CampaignRepositoryInterface;

class CampaignSenderPageAction
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
    /**
     * @var CampaignEmailSenderInterface
     */
    private $emailSender;

    public function __construct(
        Template\TemplateRendererInterface $template,
        RouterInterface $router,
        CampaignForm $form,
        CampaignRepositoryInterface $repository,
        CampaignEmailSenderInterface $emailSender
    )
    {
        $this->template = $template;
        $this->router = $router;
        $this->form = $form;
        $this->emailSender = $emailSender;
        $this->repository = $repository;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $id = $request->getAttribute('id');
        $entity = $this->repository->find($id);

        $this->form->bind($entity);

        if ($request->getMethod() == 'POST') {
            $this->emailSender->setCampaign($entity);
            $this->emailSender->send();

            $flash = $request->getAttribute('flash');
            $flash->setMessage(FlashMessageInterface::MESSAGE_SUCCESS, "Campanha enviada com sucesso!");

            $uri = $this->router->generateUri('campaign.list');

            return new RedirectResponse($uri);
        }

        return new HtmlResponse($this->template->render('app::campaign/sender', [
            'form' => $this->form
        ]));
    }
}
