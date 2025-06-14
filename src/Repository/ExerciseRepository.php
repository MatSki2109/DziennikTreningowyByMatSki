<?php

namespace App\Repository;

use App\Entity\Exercise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Exercise>
 *
 * @method Exercise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exercise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exercise[]    findAll()
 * @method Exercise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exercise::class);
    }

    // Dodaj metody wyszukiwania/filtrowania tutaj, np.:
    /**
     * @return Exercise[] Returns an array of Exercise objects filtered by muscle group
     */
    public function findByMuscleGroup(string $muscleGroup): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.muscleGroups LIKE :muscleGroup')
            ->setParameter('muscleGroup', '%' . $muscleGroup . '%')
            ->orderBy('e.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
}

