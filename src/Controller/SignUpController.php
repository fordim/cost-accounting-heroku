<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\SignInFormType;
use App\Form\Type\SignUpFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SignUpController extends AbstractController
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/signUp", name="signUp_page")
     */
    public function index(Request $request): Response
    {
        $requestUser = new User();
        $formSignIn = $this->createForm(SignInFormType::class, $requestUser);
        $formSignUp = $this->createForm(SignUpFormType::class, $requestUser);
        $formSignUp->handleRequest($request);

        if ($formSignUp->isSubmitted() && $formSignUp->isValid()) {
            $requestUser = $formSignUp->getData();
            $requestUser->setCreatedAt(new \DateTime());

            $requestUser->setPassword($this->passwordEncoder->encodePassword($requestUser, $requestUser->getPassword()));

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
        $user->setPassword($requestUser->getPassword());
        $user->setCreatedAt($requestUser->getCreatedAt());

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('SignUp new user with id '.$user->getId());
        // код ошибки и уже на фронте разруливать (зачем получать весь объект)
    }
}
