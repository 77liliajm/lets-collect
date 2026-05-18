<?php

namespace App\Controller;

use App\Repository\UtilisateurRepository;
use App\Repository\UserCollectionRepository;
use App\Repository\WishlistRepository;
use App\Repository\GroupeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class EchangeController extends AbstractController
{
    #[Route('/echange', name: 'app_echange')]
    public function index(
        Request $request,
        UtilisateurRepository $userRepo,
        UserCollectionRepository $collectionRepo,
        WishlistRepository $wishlistRepo,
        GroupeRepository $groupeRepo
    ): Response {
        $moi = $this->getUser();
        $groupeId = $request->query->get('groupe', '');

        // Mes doublons et ma wishlist
        $mesDoublons  = $collectionRepo->findDoublonsByUser($moi);
        $maWishlist   = $wishlistRepo->findBy(['utilisateur' => $moi]);

        $mesDoublonIds  = array_map(fn($uc) => $uc->getPhotocard()->getId(), $mesDoublons);
        $maWishlistIds  = array_map(fn($w)  => $w->getPhotocard()->getId(), $maWishlist);

        // Tous les autres utilisateurs
        $autresUsers = $userRepo->findAutresUsers($moi);

        $profils = [];
        foreach ($autresUsers as $user) {
            $sesDoblons  = $collectionRepo->findDoublonsByUser($user);
            $saWishlist  = $wishlistRepo->findBy(['utilisateur' => $user]);

            $sesDoublonIds = array_map(fn($uc) => $uc->getPhotocard()->getId(), $sesDoblons);
            $saWishlistIds = array_map(fn($w)  => $w->getPhotocard()->getId(), $saWishlist);

            // Score = cartes que j'ai en doublon ET qu'il veut
            //       + cartes qu'il a en doublon ET que je veux
            $score = count(array_intersect($mesDoublonIds, $saWishlistIds))
                   + count(array_intersect($sesDoublonIds, $maWishlistIds));

            if ($score === 0) continue;

            // Cartes échangeables : ce qu'il a en doublon que je veux
            $cartesQueJeVeux = array_filter($sesDoblons, fn($uc) =>
                in_array($uc->getPhotocard()->getId(), $maWishlistIds)
            );

            // Filtre par groupe si demandé
            if ($groupeId !== '') {
                $cartesQueJeVeux = array_filter($cartesQueJeVeux, function($uc) use ($groupeId) {
                    foreach ($uc->getPhotocard()->getVersions() as $v) {
                        if ($v->getAlbum()?->getGroupe()?->getId() == $groupeId) return true;
                    }
                    return false;
                });
                if (empty($cartesQueJeVeux)) continue;
            }

            $profils[] = [
                'user'           => $user,
                'score'          => $score,
                'cartesQueJeVeux'=> array_values($cartesQueJeVeux),
                'nbDoublons'     => count($sesDoublonIds),
            ];
        }

        // Trier par score décroissant
        usort($profils, fn($a, $b) => $b['score'] - $a['score']);

        return $this->render('echange/index.html.twig', [
            'profils'  => $profils,
            'groupes'  => $groupeRepo->findAll(),
            'groupeId' => $groupeId,
        ]);
    }
}