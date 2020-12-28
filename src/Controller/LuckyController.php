<?php

// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

class LuckyController extends AbstractController
{
    /**
     * @Route("/lucky/number/{max}", name="app_lucky_number")
     */

    public function number(int $max, LoggerInterface $logger): Response
    {
        $number = random_int(0, 100);

        $logger->info('We are logging!');

        $product = [];
        if ($product === null) {
            throw $this->createNotFoundException('The product does not exist');
        }

//        $url = $this->generateUrl('app_lucky_number', ['max' => 10]);

//        return $this->redirectToRoute('app_lucky_number', ['max' => 10]);
        return $this->render('lucky/number.html.twig', [
            'number' => $number,
            'numberMax' => $max
        ]);
    }
}
