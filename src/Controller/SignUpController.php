<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignUpController extends AbstractController
{
    /**
     * @Route("/signUp", name="signUp_page")
     */

    public function index(): Response
    {
        return $this->render('SignUpPage/index.html.twig', [
            'title' => 'Регистирация'
        ]);
    }
}
