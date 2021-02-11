<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\SignInFormType;
use App\Service\SessionService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SignInController extends AbstractController
{
    private SessionService $session;

    public function __construct(SessionService $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/signIn", name="signIn")
     */
    public function index(Request $request): Response
    {
        $requestUser = new User();
        $formSignIn = $this->createForm(SignInFormType::class, $requestUser);
        $formSignIn->handleRequest($request);

        if ($formSignIn->isSubmitted() && $formSignIn->isValid()) {
            $requestUser = $formSignIn->getData();

            $response = $this->checkUser($requestUser);

            return $this->redirectToRoute('cabinet_page');
        }

        return $this->redirectToRoute('signUp_page');
    }

    private function checkUser(User $requestUser): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findOneBy(['email' => $requestUser->getEmail()]);

        if ($user === null) {
            throw $this->createNotFoundException('Nobody match for this email '.$requestUser->getEmail());
        }

        if (!password_verify($requestUser->getPassword(), $user->getPassword())) {
            throw $this->createAccessDeniedException('Password does not match this email '.$requestUser->getEmail());
        }

        return new Response('Login successful with user '. $user->getName());
    }
}
