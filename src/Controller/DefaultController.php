<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Type\PictureType;
use App\Controller\UtilsController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends UtilsController
{
	/**
	 * @Route("/", name="index")
	 */
	public function __invoke(){
		$em = $this->em();
		date_default_timezone_set("Europe/Paris");
    $today = new \DateTime();
    $today->setTime(0, 0);
		$pictures = $em->getRepository(Picture::class)->findBy(['day' => $today]);
		$offset = array_rand($pictures);

		return $this->render('pages/index.html.twig', [
			'picture' => $pictures[$offset]
		]);
	}

	/**
	 * @Route("/submit", name="submit")
	 */
	public function submit(Request $request){
		$picture = new Picture();

		$form = $this->createForm(PictureType::class, $picture);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
				$em = $this->em();
				$em->persist($picture);

				$fileUpload = $form['file_upload']->getData();
				$newName = $this->generateUniqueFileName() . '.' . $fileUpload->guessClientExtension();
				$fileUpload->move($this->getParameter('pictures_directory'), $newName);
				$picture->setPath($newName);

				$em->persist($picture);
				$em->flush();

				if($picture->getName()) {
					$this->addFlash('success', 'Your picture "' . $picture->getName() . '" has been proposed successfully !');
				} else {
					$this->addFlash('success', 'Your picture has been proposed successfully !');
				}

				return $this->redirectToRoute('index');
		}

		return $this->render('pages/submit.html.twig', [
			'form' => $form->createView(),
			'task' => 'submit'
		]);
	}

	/**
	 * @Route("/about-us", name="about")
	 */
	public function about(){
		return $this->render('pages/about_us.html.twig');
	}
}