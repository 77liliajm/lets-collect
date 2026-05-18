<?php

namespace App\Repository;

use App\Entity\Utilisateur;
use App\Entity\Wishlist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class WishlistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wishlist::class);
    }

    public function findByUserGrouped(Utilisateur $user): array
    {
        $items = $this->createQueryBuilder('w')
            ->join('w.photocard', 'p')
            ->leftJoin('p.versions', 'av')
            ->leftJoin('av.album', 'a')
            ->leftJoin('a.groupe', 'g')
            ->leftJoin('p.idols', 'i')
            ->addSelect('p', 'av', 'a', 'g', 'i')
            ->where('w.utilisateur = :user')
            ->setParameter('user', $user)
            ->orderBy('g.nom', 'ASC')
            ->addOrderBy('a.titre', 'ASC')
            ->getQuery()
            ->getResult();

        $grouped = [];
        foreach ($items as $item) {
            $photocard = $item->getPhotocard();
            foreach ($photocard->getVersions() as $version) {
                $album = $version->getAlbum();
                $groupe = $album?->getGroupe();
                $groupeNom = $groupe ? $groupe->getNom() : 'Autres';
                $grouped[$groupeNom][] = $item;
            }
        }

        return $grouped;
    }
}