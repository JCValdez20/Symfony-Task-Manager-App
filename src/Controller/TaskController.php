<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TaskRepository;
use App\Form\TaskType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;


final class TaskController extends AbstractController
{
    #[Route('/task', name: 'app_task')]
    public function index(TaskRepository $repository): Response
    {
        $tasks = $repository->findAll();

        return $this->render('task/index.html.twig', [
            'tasks' => $repository->findAll(),
        ]);
    }
    #[Route('/task/new', name: 'app_task_new')]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $task = new Task;

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($task);
            $manager->flush();

            $this->addFlash('success', 'Task created successfully!');

            return $this->redirectToRoute('app_task');
        }

        return $this->render('task/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/task/{id<\d+>}/delete', name:'task_delete', methods: ['POST'])]
    public function delete(Task $task, EntityManagerInterface $manager): Response
    {
        $manager->remove($task);
        $manager->flush();


        $this->addFlash('success', 'Task deleted successfully!');

        return $this->redirectToRoute('app_task');
    }

    #[Route('/task/{id<\d+>}/edit', name:'task_edit')]
    public function edit(Task $task, Request $request, EntityManagerInterface $manager): Response
     {

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            
            $manager->flush();

            $this->addFlash('success', 'Task Updated successfully!');

            return $this->redirectToRoute('app_task');
        }

        return $this->render('task/edit.html.twig', [
            'form' => $form,
            'task' => $task,
        ]);
    }

}