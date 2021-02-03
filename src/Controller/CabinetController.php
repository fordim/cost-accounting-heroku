<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CabinetController extends AbstractController
{
    private SessionInterface $session;
    private TokenStorageInterface $tokenStorage;

    public function __construct(SessionInterface $session, TokenStorageInterface $tokenStorage)
    {
        $this->session = $session;
        $this->tokenStorage = $tokenStorage;
    }


    /**
     * @Route("/cabinet", name="cabinet_page")
     */
    public function index(Request $request): Response
    {
        //Доставать токен и всю инфу по юзеру который залогинен
//        dd($this->tokenStorage->getToken());

        //Доставать токен и всю инфу по юзеру который залогинен
        dd($user = $this->getUser());

        return $this->render('Cabinet/index.html.twig', [
            'title' => 'Кабинет'
        ]);
    }
}
