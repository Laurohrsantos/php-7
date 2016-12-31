<?php

namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository;

use CodeEmailMKT\Domain\Entity\Tag;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;

class CustomerRepository extends AbstratcRepository implements CustomerRepositoryInterface
{

    public function finByTag(array $tags): array
    {
        $qd = $this->createQueryBuilder('c')
            ->distinct()
            ->leftJoin(Tag::class, 't')
            ->andWhere('t.id IN (:tags_id)')
            ->setParameter('tags_id', $tags);

        return $qd->getQuery()->getResult();
    }
}