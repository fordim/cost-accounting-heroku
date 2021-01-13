<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainPageController extends AbstractController
{
    /**
     * @Route("/", name="main_page")
     */

    public function index(): Response
    {
        return $this->render('MainPage/index.html.twig', [
            'title' => 'Cost accounting'
        ]);
    }
}
