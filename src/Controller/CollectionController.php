<?php

namespace App\Controller;

use App\Entity\UserCollection;
use App\Repository\UserCollectionRepository;
use App\Repository\PhotocardRepository;
use App\Repository\WishlistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Doctrine\ORM\EntityManagerInterface;

#[IsGranted('ROLE_USER')]
class CollectionController extends AbstractController
{
    #[Route('/collection', name: 'app_collection')]
    public function index(UserCollectionRepository $collectionRepo): Response
    {
        $user = $this->getUser();
        $collection = $collectionRepo->findByUserGrouped($user);
        $doublons   = $collectionRepo->findDoublonsByUser($user);

        return $this->render('collection/index.html.twig', [
            'collection' => $collection,
            'doublons'   => $doublons,
        ]);
    }

    #[Route('/collection/update/{id}', name: 'app_collection_update', methods: ['POST'])]
    public function update(
        int $id,
        Request $request,
        PhotocardRepository $photocardRepo,
        UserCollectionRepository $collectionRepo,
        EntityManagerInterface $em
    ): JsonResponse {
        $user      = $this->getUser();
        $action    = $request->request->get('action');
        $photocard = $photocardRepo->find($id);

        if (!$photocard) {
            return new JsonResponse(['error' => 'Carte introuvable'], 404);
        }

        $item = $collectionRepo->findOneBy([
            'utilisateur' => $user,
            'photocard'   => $photocard,
        ]);

        if ($action === 'increment') {
            if (!$item) {
                $item = new UserCollection();
                $item->setUtilisateur($user);
                $item->setPhotocard($photocard);
                $item->setDateAjout(new \DateTime());
                $em->persist($item);
            }
            $item->setQuantite($item->getQuantite() + 1);
            $item->updateEtat();
        } elseif ($action === 'decrement' && $item) {
            $newQty = $item->getQuantite() - 1;
            if ($newQty <= 0) {
                $em->remove($item);
                $em->flush();
                return new JsonResponse(['quantite' => 0, 'etat' => 'absent']);
            }
            $item->setQuantite($newQty);
            $item->updateEtat();
        }

        $em->flush();

        return new JsonResponse([
            'quantite' => $item->getQuantite(),
            'etat'     => $item->getEtat(),
        ]);
    }

    #[Route('/wishlist/toggle/{id}', name: 'app_wishlist_toggle', methods: ['POST'])]
    public function toggleWishlist(
        int $id,
        PhotocardRepository $photocardRepo,
        WishlistRepository $wishlistRepo,
        EntityManagerInterface $em
    ): JsonResponse {
        $user      = $this->getUser();
        $photocard = $photocardRepo->find($id);

        if (!$photocard) {
            return new JsonResponse(['error' => 'Carte introuvable'], 404);
        }

        $item = $wishlistRepo->findOneBy([
            'utilisateur' => $user,
            'photocard'   => $photocard,
        ]);

        if ($item) {
            $em->remove($item);
            $em->flush();
            return new JsonResponse(['wishlisted' => false]);
        }

        $wishlist = new \App\Entity\Wishlist();
        $wishlist->setUtilisateur($user);
        $wishlist->setPhotocard($photocard);
        $wishlist->setDateAjout(new \DateTime());
        $em->persist($wishlist);
        $em->flush();

        return new JsonResponse(['wishlisted' => true]);
    }
}