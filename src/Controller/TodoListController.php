<?php

namespace App\Controller;

use App\Entity\TodoList;
use App\Repository\TodoListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TodoListController extends AbstractController
{
    public function __construct(private readonly TodoListRepository $listRepository, private readonly EntityManagerInterface $entityManager)
    {
    }

    #[Route('/lists', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $lists = $this->listRepository->findAll();

        return $this->json($lists);
    }


    #[Route('/lists', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $list = (new TodoList())
            ->setName($request->get('name'));

        $this->entityManager->persist($list);
        $this->entityManager->flush();
        // Or you can create a save method in the repository
        // $this->listRepository->save($list);

        return new Response(null, Response::HTTP_CREATED);
    }
}
