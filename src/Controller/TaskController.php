<?php


namespace App\Controller;

use App\Entity\Task;
use App\Entity\Users;
use App\Form\Type\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{

    /**
     * @Route("/task", name="task_page")
     */
    public function new(Request $request): Response
    {
//        dd($request);
        // just setup a fresh $task object (remove the example data)
        $task = new Task();

        $form = $this->createForm(TaskType::class, $task);

//        dd($form);

        $form->handleRequest($request);

//        dd($form->getData());
//        dd($form);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $task->setCreatedAt(new \DateTime());
            $task->setPasswordHash(password_hash($task->getPasswordHash(), PASSWORD_DEFAULT));

            $response = $this->createUser($task);

            return $this->redirectToRoute('signUp_page');
        }

        return $this->render('Task/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function createUser(Task $task): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $user = new Users();
        $user->setEmail($task->getEmail());
        $user->setName($task->getName());
        $user->setPasswordHash($task->getPasswordHash());
        $user->setCreatedAt($task->getCreatedAt());

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$user->getId());
    }
}
