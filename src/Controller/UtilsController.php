<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UtilsController extends AbstractController
{
  public function isTokenValid($token)
  {
    $intention = '1DAY_1BEER_SECURITY_TOKEN';
    if ($token === null) {
        throw $this->createNotFoundException();
    }
    if (!$this->isCsrfTokenValid($intention, $token)) {
        throw $this->createNotFoundException();
    }
  }

  public function em()
  {
    return $em = $this->getDoctrine()->getManager();
  }

  public function localDateTime()
  {
		date_default_timezone_set("Europe/Paris");
    $today = new \DateTime();
    $today->setTime(0, 0);
    return $today;
  }

  public function generateUniqueFileName()
  {
    $date = \DateTime::createFromFormat('U.u', microtime(TRUE));
    $filename = md5($date->format('Y-m-d H:i:s:u'));
    return $filename;
  }
}