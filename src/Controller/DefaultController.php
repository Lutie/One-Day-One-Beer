<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
	/**
	 * @Route("/", name="index")
	 */
	public function __invoke(){
		return $this->render('pages/index.html.twig');
	}

	/**
	 * @Route("/submit", name="submit")
	 */
	public function submit(){
		return $this->render('pages/submit.html.twig');
	}

	/**
	 * @Route("/about-us", name="about")
	 */
	public function about(){
		return $this->render('pages/about_us.html.twig');
	}
}