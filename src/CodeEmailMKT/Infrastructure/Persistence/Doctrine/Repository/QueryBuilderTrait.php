<?php

namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository;

trait QueryBuilderTrait
{

    protected $queryBuilder;

    public function getQueryBuilder()
    {
        return $this->queryBuilder;
    }

    public function setQueryBuilder($queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

}