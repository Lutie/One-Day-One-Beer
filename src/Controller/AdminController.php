<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminController extends AbstractController
{
  /**
   * @Route("/admin", name="admin")
   */
  public function __invoke(){
    return $this->render('admin/index.html.twig');
  }
}