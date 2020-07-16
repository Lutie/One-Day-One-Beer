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

  public function findPreviousOne()
  {
    $qb = $this->createQueryBuilder('pictures');
		date_default_timezone_set("Europe/Paris");
    $today = new \DateTime();
    $today->setTime(0, 0);

    $qb
      ->select('pictures')
      ->where('pictures.day is not NULL')
      ->andWhere('pictures.day <= :today')
      ->setParameter('today', $today);
    
      return $qb
      ->getQuery()
      ->getResult();
  }

}