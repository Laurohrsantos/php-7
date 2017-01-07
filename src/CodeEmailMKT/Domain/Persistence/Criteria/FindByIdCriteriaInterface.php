<?php

declare(strict_types = 1);

namespace CodeEmailMKT\Domain\Persistence\Criteria;

use CodeEmailMKT\Domain\Persistence\CriteriaInterface;

interface FindByIdCriteriaInterface extends CriteriaInterface
{
    public function setId(int $id);

    public function getId(): int;
}