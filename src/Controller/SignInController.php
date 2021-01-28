<?php


namespace App\Controller;

use App\Entity\Users;
use App\Form\Type\SignInFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SignInController extends AbstractController
{
    /**
     * @Route("/signIn", name="signIn")
     */
    public function index(Request $request): Response
    {
        $requestUser = new Users();
        $formSignIn = $this->createForm(SignInFormType::class, $requestUser);
        $formSignIn->handleRequest($request);

        if ($formSignIn->isSubmitted() && $formSignIn->isValid()) {
            $requestUser = $formSignIn->getData();

            $response = $this->checkUser($requestUser);

            return $this->redirectToRoute('cabinet_page');
        }

        return $this->redirectToRoute('signUp_page');
    }

    private function checkUser(Users $requestUser): Response
    {
        $repository = $this->getDoctrine()->getRepository(Users::class);
        $user = $repository->findOneBy(['email' => $requestUser->getEmail()]);

        if ($user === null) {
            return new Response('Nobody match for this email '.$requestUser->getEmail());
        }

        if (!password_verify($requestUser->getPasswordHash(), $user->getPasswordHash())) {
            return new Response('Password does not match this email '.$requestUser->getEmail());
        };

        return new Response('Login successful with user '. $user->getName());
    }
}
