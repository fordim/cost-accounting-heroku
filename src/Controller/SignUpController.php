<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\SignInFormType;
use App\Form\Type\SignUpFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\SessionService;

class SignUpController extends AbstractController
{
    private SessionService $session;

    public function __construct(SessionService $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/signUp", name="signUp_page")
     */
    public function index(Request $request): Response
    {
        $this->session->signIn(1, 'Test');

        dd($user = $this->getUser());

//        dd($this->session->getUserId());

        $requestUser = new User();
        $formSignIn = $this->createForm(SignInFormType::class, $requestUser);
        $formSignUp = $this->createForm(SignUpFormType::class, $requestUser);
        $formSignUp->handleRequest($request);

        if ($formSignUp->isSubmitted() && $formSignUp->isValid()) {
            $requestUser = $formSignUp->getData();
            $requestUser->setCreatedAt(new \DateTime());
            $requestUser->setPasswordHash(password_hash($requestUser->getPasswordHash(), PASSWORD_DEFAULT));

            $response = $this->createUser($requestUser);

            return $this->redirectToRoute('cabinet_page');
        };

        return $this->render('SignUpPage/index.html.twig', [
            'title' => 'Регистирация',
            'formSignUp' => $formSignUp->createView(),
            'formSignIn' => $formSignIn->createView()
        ]);
    }

    private function createUser(User $requestUser): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setEmail($requestUser->getEmail());
        $user->setName($requestUser->getName());
        $user->setRoles(["ROLE_USER"]);
        $user->setPasswordHash($requestUser->getPasswordHash());
        $user->setCreatedAt($requestUser->getCreatedAt());

//        dd($user->getRoles());

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('SignUp new user with id '.$user->getId());
        // код ошибки и уже на фронте разруливать (зачем получать весь объект)
    }
}
