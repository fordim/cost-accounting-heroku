<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\Type\SignInFormType;
use App\Form\Type\SignUpFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignUpController extends AbstractController
{
    /**
     * @Route("/signUp", name="signUp_page")
     */
    public function index(Request $request): Response
    {
        $requestUser = new Users();
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

    private function createUser(Users $requestUser): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new Users();
        $user->setEmail($requestUser->getEmail());
        $user->setName($requestUser->getName());
        $user->setPasswordHash($requestUser->getPasswordHash());
        $user->setCreatedAt($requestUser->getCreatedAt());

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('SignUp new user with id '.$user->getId());
        // код ошибки и уже на фронте разруливать (зачем получать весь объект)
    }
}
