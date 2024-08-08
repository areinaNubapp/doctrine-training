<?php

namespace App\Repository;

use App\Entity\TodoList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TodoList>
 */
class TodoListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TodoList::class);
    }

    /**
     * @return TodoList[] Returns an array of TodoList objects
     */
    public function findByExampleField($value): array
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->getQuery()
            ->getResult()
        ;
    }

    public function save(TodoList $list): void
    {
        $this->_em->persist($list);
        $this->_em->flush();
    }

    //    public function findOneBySomeField($value): ?TodoList
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
