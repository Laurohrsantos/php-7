<?php

namespace CodeEmailMKT\Application\Action\Tag;

use CodeEmailMKT\Domain\Service\FlashMessageInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;
use CodeEmailMKT\Domain\Persistence\TagRepositoryInterface;

class TagListPageAction
{
    private $template;
    /**
     * @var TagRepositoryInterface
     */
    private $repository;

    public function __construct(TagRepositoryInterface $repository, Template\TemplateRendererInterface $template)
    {
        $this->template = $template;
        $this->repository = $repository;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $tags = $this->repository->findAll();
        $flash = $request->getAttribute('flash');

        return new HtmlResponse($this->template->render('app::tag/list', [
            'tags' => $tags,
            'message' => $flash->getMessage(FlashMessageInterface::MESSAGE_SUCCESS)
        ]));
    }
}
