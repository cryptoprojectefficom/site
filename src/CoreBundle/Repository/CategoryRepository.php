<?php

namespace CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class CategoryRepository extends EntityRepository
{
    public function getCategoryId()
    {
      $qb = $this->createQueryBuilder('category');

      $query = $qb
      ->select('category.id')
      ->getQuery();

      return $query->getResult();
    }
}
