<?php

namespace App\Controller;

use App\Repository\GroupeRepository;
use App\Repository\IdolRepository;
use App\Repository\PhotocardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RechercheController extends AbstractController
{
    #[Route('/recherche', name: 'app_recherche')]
    public function index(
        Request $request,
        PhotocardRepository $photocardRepo,
        GroupeRepository $groupeRepo,
        IdolRepository $idolRepo
    ): Response {
        $terme    = $request->query->get('terme', '');
        $groupeId = $request->query->get('groupe', '');
        $idolId   = $request->query->get('idol', '');

        $photocards = $photocardRepo->search($terme, $groupeId, $idolId);
        $groupes    = $groupeRepo->findAll();
        $idols      = $groupeId ? $idolRepo->findByGroupe((int)$groupeId) : [];

        return $this->render('recherche/index.html.twig', [
            'photocards' => $photocards,
            'groupes'    => $groupes,
            'idols'      => $idols,
            'terme'      => $terme,
            'groupeId'   => $groupeId,
            'idolId'     => $idolId,
        ]);
    }
}