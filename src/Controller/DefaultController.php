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
    $today = $this->localDateTime();
		$pictures = $em->getRepository(Picture::class)->findBy(['day' => $today]);
		if(sizeof($pictures) == 0) {
			$pictures = $em->getRepository(Picture::class)->findValidatedOne();
		}

		return $this->render('pages/index.html.twig', [
			'picture' => sizeof($pictures) > 0 ? $pictures[$offset] : null
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
   * @Route("/picture-gallery/{offset}", name="picture-gallery", requirements={"offset":"\d+"})
	 */
	public function gallery(int $offset){
		$em = $this->em();
		$pictures = $em->getRepository(Picture::class)->findPreviousOne();
		$maxoffset = count($pictures) - 1;
		if($offset > $maxoffset){
			$offset = $maxoffset;
		}

		return $this->render('pages/previous.html.twig', [
			'picture' => sizeof($pictures) > 0 ? $pictures[$offset] : null,
			'offset' => $offset,
			'maxoffset' => $maxoffset
		]);
	}

	/**
	 * @Route("/about-us", name="about")
	 */
	public function about(){
		return $this->render('pages/about_us.html.twig');
	}
}