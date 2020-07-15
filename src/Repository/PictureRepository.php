<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class PictureRepository extends EntityRepository
{

  public function findValidatedOne()
  {
    $qb = $this->createQueryBuilder('pictures');

    $qb
      ->select('pictures')
      ->where('pictures.day is not NULL');
    
      return $qb
      ->getQuery()
      ->getResult();
  }

}