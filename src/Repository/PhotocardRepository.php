<?php

namespace App\Repository;

use App\Entity\Photocard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PhotocardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Photocard::class);
    }

    public function search(string $terme = '', int|string $groupeId = '', int|string $idolId = ''): array
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.versions', 'av')
            ->leftJoin('av.album', 'a')
            ->leftJoin('a.groupe', 'g')
            ->leftJoin('p.idols', 'i')
            ->addSelect('av', 'a', 'g', 'i');

        if ($terme !== '') {
            $qb->andWhere(
                $qb->expr()->orX(
                    $qb->expr()->like('p.nom_set', ':terme'),
                    $qb->expr()->like('i.nom_scene', ':terme'),
                    $qb->expr()->like('a.titre', ':terme'),
                    $qb->expr()->like('g.nom', ':terme')
                )
            )->setParameter('terme', '%' . $terme . '%');
        }

        if ($groupeId !== '') {
            $qb->andWhere('g.id = :groupeId')
               ->setParameter('groupeId', $groupeId);
        }

        if ($idolId !== '') {
            $qb->andWhere('i.id = :idolId')
               ->setParameter('idolId', $idolId);
        }

        return $qb->orderBy('g.nom', 'ASC')
                  ->addOrderBy('a.titre', 'ASC')
                  ->addOrderBy('p.nom_set', 'ASC')
                  ->getQuery()
                  ->getResult();
    }
}