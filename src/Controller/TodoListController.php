<?php

namespace App\Controller;

use App\Entity\TodoList;
use App\Repository\TodoListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class TodoListController extends AbstractController
{
    public function __construct(private readonly TodoListRepository $listRepository)
    {
    }

    #[Route('/lists', name: 'app_todo_lists', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $lists = $this->listRepository->findAll();

        return $this->json($lists);
    }


    #[Route('/lists', name: 'app_todo_lists', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $list = (new TodoList())
            ->setName($request->get('name'));

        $lists = $this->listRepository->persist($list);

        $this->listRepository->flush();

        return $this->json($lists);
    }
}
