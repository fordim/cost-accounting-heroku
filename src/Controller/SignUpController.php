<?php


namespace App\Controller;

use App\Entity\Task;
use App\Entity\Users;
use App\Form\Type\TaskType;
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
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $task->setCreatedAt(new \DateTime());
            $task->setPasswordHash(password_hash($task->getPasswordHash(), PASSWORD_DEFAULT));

            $response = $this->createUser($task);

            return $this->redirectToRoute('signUp_page');
        }

        return $this->render('SignUpPage/index.html.twig', [
            'title' => 'Регистирация',
            'form' => $form->createView()
        ]);
    }

    public function createUser(Task $task): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new Users();
        $user->setEmail($task->getEmail());
        $user->setName($task->getName());
        $user->setPasswordHash($task->getPasswordHash());
        $user->setCreatedAt($task->getCreatedAt());

        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('SignUp new user with id '.$user->getId());
    }
}
