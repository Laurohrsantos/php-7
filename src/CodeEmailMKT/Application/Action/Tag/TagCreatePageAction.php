<?php

namespace CodeEmailMKT\Application\Action\Tag;

use CodeEmailMKT\Application\Form\TagForm;
use CodeEmailMKT\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template;
use CodeEmailMKT\Domain\Persistence\TagRepositoryInterface;

class TagCreatePageAction
{
    private $template;

    /**
     * @var TagRepositoryInterface
     */
    private $repository;

    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var TagForm
     */
    private $form;

    public function __construct(
        TagRepositoryInterface $repository,
        Template\TemplateRendererInterface $template,
        RouterInterface $router,
        TagForm $form
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

                $flash->setMessage(FlashMessageInterface::MESSAGE_SUCCESS, "Tag cadastrada com sucesso!");

                $uri = $this->router->generateUri('tag.list');

                return new RedirectResponse($uri);
            }

        }

        return new HtmlResponse($this->template->render('app::tag/create', [
            'form' => $this->form
        ]));
    }
}
