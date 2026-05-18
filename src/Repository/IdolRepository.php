<?php

namespace App\Repository;

use App\Entity\Idol;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class IdolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Idol::class);
    }

        public function findByGroupe(int $groupeId): array
    {
        return $this->createQueryBuilder('i')
            ->join('i.photocards', 'p')
            ->join('p.versions', 'av')
            ->join('av.album', 'a')
            ->join('a.groupe', 'g')
            ->where('g.id = :groupeId')
            ->setParameter('groupeId', $groupeId)
            ->orderBy('i.nom_scene', 'ASC')
            ->distinct()
            ->getQuery()
            ->getResult();
    }
}