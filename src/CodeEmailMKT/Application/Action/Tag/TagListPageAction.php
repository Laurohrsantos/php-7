<?php

namespace CodeEmailMKT\Application\Action\Tag;

use CodeEmailMKT\Domain\Persistence\Criteria\FindByIdCriteriaInterface;
use CodeEmailMKT\Domain\Persistence\Criteria\FindByNameCriteriaInterface;
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
    /**
     * @var FindByNameCriteriaInterface
     */
    private $findByNameCriteria;
    /**
     * @var FindByIdCriteriaInterface
     */
    private $findByIdCriteria;

    public function __construct
    (
        TagRepositoryInterface $repository,
        Template\TemplateRendererInterface $template,
        FindByNameCriteriaInterface $findByNameCriteria,
        FindByIdCriteriaInterface $findByIdCriteria
    )
    {
        $this->template = $template;
        $this->repository = $repository;
        $this->findByNameCriteria = $findByNameCriteria;
        $this->findByIdCriteria = $findByIdCriteria;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $this->findByNameCriteria->setName('');
        $this->findByIdCriteria->setId('101');
        $this->repository->add($this->findByNameCriteria);
        $this->repository->add($this->findByIdCriteria);
        $tags = $this->repository->findAll();
        $flash = $request->getAttribute('flash');

        return new HtmlResponse($this->template->render('app::tag/list', [
            'tags' => $tags,
            'message' => $flash->getMessage(FlashMessageInterface::MESSAGE_SUCCESS)
        ]));
    }
}
