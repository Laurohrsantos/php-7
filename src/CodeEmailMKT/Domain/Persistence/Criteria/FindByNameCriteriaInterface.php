<?php

declare(strict_types = 1);

namespace CodeEmailMKT\Domain\Persistence\Criteria;

use CodeEmailMKT\Domain\Persistence\CriteriaInterface;

interface FindByNameCriteriaInterface extends CriteriaInterface
{
    public function setName(string $name);

    public function getNAme(): string;
}