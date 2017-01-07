<?php

namespace CodeEmailMKT\Domain\Persistence;

interface RepositoryCriteriaInterface
{
    public function add(CriteriaInterface $criteria);

    public function set(array $criterias);

    public function findWithCriteria();

    public function setQueryBuilder($queryBuilder);

    public function getQueryBuilder();
}