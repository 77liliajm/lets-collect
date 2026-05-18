<?php

namespace App\Repository;

use App\Entity\UserCollection;
use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserCollectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCollection::class);
    }

    public function findByUserGrouped(Utilisateur $user): array
    {
        $items = $this->createQueryBuilder('uc')
            ->join('uc.photocard', 'p')
            ->leftJoin('p.versions', 'av')
            ->leftJoin('av.album', 'a')
            ->leftJoin('a.groupe', 'g')
            ->addSelect('p', 'av', 'a', 'g')
            ->where('uc.utilisateur = :user')
            ->andWhere('uc.quantite >= 1')
            ->setParameter('user', $user)
            ->orderBy('g.nom', 'ASC')
            ->addOrderBy('a.titre', 'ASC')
            ->addOrderBy('av.nom_version', 'ASC')
            ->getQuery()
            ->getResult();

        $grouped = [];
        foreach ($items as $item) {
            $photocard = $item->getPhotocard();
            foreach ($photocard->getVersions() as $version) {
                $album = $version->getAlbum();
                $groupe = $album ? $album->getGroupe() : null;
                $groupeNom = $groupe ? $groupe->getNom() : 'Autres';
                $albumTitre = $album ? $album->getTitre() : 'Inconnu';
                $versionNom = $version->getNomVersion();
                $grouped[$groupeNom][$albumTitre][$versionNom][] = $item;
            }
        }

        return $grouped;
    }

    public function findDoublonsByUser(Utilisateur $user): array
    {
        return $this->createQueryBuilder('uc')
            ->join('uc.photocard', 'p')
            ->addSelect('p')
            ->where('uc.utilisateur = :user')
            ->andWhere('uc.quantite > 1')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }
}