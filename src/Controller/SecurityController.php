<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
  /**
   * @Route("/login", name="login")
   */
  public function __invoke(AuthenticationUtils $authenticationUtils)
  {
      $error = $authenticationUtils->getLastAuthenticationError();
      $username = $authenticationUtils->getLastUsername();

      return $this->render('pages/login.html.twig', [
          'error' => $error,
          'username' => $username,
      ]);
  }
}