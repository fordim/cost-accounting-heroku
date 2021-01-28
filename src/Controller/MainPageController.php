<?php


namespace App\Controller;

use App\Entity\Users;
use App\Form\Type\SignInFormType;
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
        $requestUser = new Users();
        $formSignIn = $this->createForm(SignInFormType::class, $requestUser);

        return $this->render('MainPage/index.html.twig', [
            'title' => 'Cost accounting',
            'formSignIn' => $formSignIn->createView()
        ]);
    }
}
