<?php

namespace CodeEmailMKT\Domain\Persistence;

interface CustomerRepositoryInterface extends RepositoryInterface
{
    public function finByTag (array $tags) : array;
}