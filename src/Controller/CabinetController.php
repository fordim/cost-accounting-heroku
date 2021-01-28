<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CabinetController extends AbstractController
{
    /**
     * @Route("/cabinet", name="cabinet_page")
     */
    public function index(Request $request): Response
    {
        return $this->render('Cabinet/index.html.twig', [
            'title' => 'Кабинет'
        ]);
    }
}
