<?php

namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository\Criteria;

use CodeEmailMKT\Domain\Persistence\Criteria\FindByIdCriteriaInterface;
use CodeEmailMKT\Domain\Persistence\RepositoryCriteriaInterface;
use Doctrine\ORM\QueryBuilder;

class FindByIdCriteria implements FindByIdCriteriaInterface
{

    private $id;

    public function apply(RepositoryCriteriaInterface $repository)
    {

        $alias = $repository->ALIAS_ENTITY;

        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = $repository->getQueryBuilder();
        $queryBuilder->andWhere("$alias.id = :id")
            ->setParameter('id', $this->getId());
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}