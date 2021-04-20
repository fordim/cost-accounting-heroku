<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractFOSRestController
{
    /**
     * @Route("/api", name="api_test")
     */
    public function getUsersAction()
    {
        $data = ['test', 'test2', 'test3']; // get data, in this case list of users.
        $view = $this->view($data, 200);

        return $view;
    }

    public function redirectAction()
    {
        $view = $this->redirectView($this->generateUrl('api_test'), 301);
        // or test
        $view = $this->routeRedirectView('api_test', array(), 301);

        return $this->handleView($view);
    }
}
