<?php

namespace CodeEmailMKT\Domain\Persistence;

interface CriteriaInterface
{
    public function apply(RepositoryCriteriaInterface $repository);
}