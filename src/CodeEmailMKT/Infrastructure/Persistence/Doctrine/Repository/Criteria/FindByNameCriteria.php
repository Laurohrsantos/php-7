<?php

namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository\Criteria;

use CodeEmailMKT\Domain\Persistence\Criteria\FindByNameCriteriaInterface;
use CodeEmailMKT\Domain\Persistence\RepositoryCriteriaInterface;
use Doctrine\ORM\QueryBuilder;

class FindByNameCriteria implements FindByNameCriteriaInterface
{

    private $name;

    public function apply(RepositoryCriteriaInterface $repository)
    {

        $alias = $repository->ALIAS_ENTITY;

        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = $repository->getQueryBuilder();
        $queryBuilder->andWhere("$alias.name = :name")
            ->setParameter('name', $this->getNAme());
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getNAme(): string
    {
        return $this->name;
    }
}