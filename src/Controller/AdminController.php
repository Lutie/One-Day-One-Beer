<?php

namespace App\Controller;

use App\Entity\Picture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security("has_role('ROLE_ADMIN')")
 */
class AdminController extends UtilsController
{
  /**
   * @Route("/admin", name="admin")
   */
  public function __invoke(Request $request){
    $em = $this->em();
    $pictures = $em->getRepository(Picture::class)->findAll();
    return $this->render('admin/index.html.twig', [
      'pictures' => $pictures,
    ]);
  }

  /**
   * @Route("/picture-activate/{id}", name="picture-activate", requirements={"id":"\d+"})
   */
  public function activatePicture(Request $request, Picture $picture){
    $this->isTokenValid($request->query->get('token'));
    $picture->setValidated(!$picture->getValidated());
    $em = $this->em();
    $em->persist($picture);
    $em->flush();
    if($picture->getValidated()) {
      $this->addFlash('success', 'The picture has been validated successfully.');
    } else {
      $this->addFlash('success', 'The picture has been devalidated successfully.');
    }
    return $this->redirectToRoute('admin');
  }

  /**
   * @Route("/picture-delete/{id}", name="picture-delete", requirements={"id":"\d+"})
   */
  public function deletePicture(Request $request, Picture $picture){
    $this->isTokenValid($request->query->get('token'));
    $em = $this->em();
    $em->remove($picture);
    $em->flush();
    $this->addFlash('success', 'The picture has been deleted successfully.');
    return $this->redirectToRoute('admin');
  }
}