<?php

namespace App\Repository;

use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateur::class);
    }

    public function findAutresUsers(Utilisateur $moi): array
    {
        return $this->createQueryBuilder('u')
            ->where('u != :moi')
            ->setParameter('moi', $moi)
            ->orderBy('u.pseudo', 'ASC')
            ->getQuery()
            ->getResult();
    }
}