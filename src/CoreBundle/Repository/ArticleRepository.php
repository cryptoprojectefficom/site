<?php

namespace CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class ArticleRepository extends EntityRepository
{
  public function getArticleWithCategories($categoryId)
  {
    $qb = $this->createQueryBuilder('a');

    // On fait une jointure avec l'entité Category avec pour alias « c »
    $qb
      ->innerJoin('a.categories', 'c')
      ->addSelect('c')
    ;

    // Puis on filtre sur le nom des catégories à l'aide d'un IN
    $qb->where($qb->expr()->in('c.id', $categoryId));

    // La syntaxe du IN et d'autres expressions se trouve dans la documentation Doctrine

    // Enfin, on retourne le résultat
    return $qb
      ->getQuery()
      ->getResult()
    ;
  }
  public function getArticleWithCategoriesLimit($categoryId)
  {
    $qb = $this->createQueryBuilder('a');
    $qb
      ->leftJoin('a.categories', 'c')
      ->addSelect('c')
    ;
    $qb->where($qb->expr()->in('c.id', $categoryId));

    $qb->orderBy('a.date', 'DESC');
    $qb->setMaxResults(3);

    return $qb
      ->getQuery()
      ->getResult()
    ;
  }
  public function getArticleWithCommentAndNoComment($articleId)
  {
    $qb = $this->createQueryBuilder('a');


    $qb
        ->leftJoin('a.image', 'i')
        ->leftJoin('a.categories', 'c')
        ->leftJoin('a.comment', 'co')
        ->join('co.user', 'u')
        ->leftJoin('u.avatar', 'av')
        ->addSelect('c')
        ->addSelect('av')
        ->addSelect('u')
        ->addSelect('i')
        ->addSelect('co')
        ->where('a.id = :id')
        ->setParameter('id', $articleId)
      ;

      return $qb->getQuery()->getSingleResult();
  }
}
