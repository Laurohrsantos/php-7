<?php

namespace CodeEmailMKT\Application\Action\Tag\Factory;

use CodeEmailMKT\Application\Action\Tag\TagListPageAction;
use CodeEmailMKT\Domain\Persistence\Criteria\FindByIdCriteriaInterface;
use CodeEmailMKT\Domain\Persistence\Criteria\FindByNameCriteriaInterface;
use CodeEmailMKT\Domain\Persistence\TagRepositoryInterface;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class TagListPageFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(TagRepositoryInterface::class);
        $findByNameCriteria = $container->get(FindByNameCriteriaInterface::class);
        $findByIdCriteria = $container->get(FindByIdCriteriaInterface::class);

        return new TagListPageAction($repository ,$template, $findByNameCriteria, $findByIdCriteria);
    }
}
