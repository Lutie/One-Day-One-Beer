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
   * @Route("/{offset}", name="picture-gallery", requirements={"offset":"\d+"})
	 */
	public function __invoke(int $offset = 0){
		$em = $this->em();
		$today = $this->localDateTime();
		$pictures = $em->getRepository(Picture::class)->findBy(['day' => $today]);
		$previous = $em->getRepository(Picture::class)->findPreviousOne();
		$picToDisplay = (sizeof($previous) != 0);

		$maxoffset = count($previous) > 0 ? count($previous) - 1 : 0;
		if($offset > $maxoffset){
			$offset = $maxoffset;
		}
		if(sizeof($pictures) == 0) {
			$pictures = $em->getRepository(Picture::class)->findValidatedOne();
		}

		return $this->render('pages/index.html.twig', [
			'picture' => $picToDisplay ? $previous[$offset] : null,
			'offset' => $offset,
			'maxoffset' => $maxoffset
		]);
	}

	/**
	 * @Route("/picture-submit", name="picture-submit")
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
	 * @Route("/about", name="about")
	 */
	public function about(){
		return $this->render('pages/about.html.twig');
	}

	/**
	 * @Route("/about-us", name="about-us")
	 */
	public function aboutUs(){
		return $this->render('pages/about_us.html.twig');
	}
}