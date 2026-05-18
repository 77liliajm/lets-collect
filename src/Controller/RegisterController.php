<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function index(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher
    ): Response {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_accueil');
        }

        $error = null;

        if ($request->isMethod('POST')) {
            $pseudo   = trim($request->request->get('pseudo', ''));
            $email    = trim($request->request->get('email', ''));
            $password = $request->request->get('password', '');
            $ville    = trim($request->request->get('ville', ''));

            if (empty($pseudo) || empty($email) || empty($password)) {
                $error = 'Pseudo, email et mot de passe sont obligatoires.';
            } else {
                $user = new Utilisateur();
                $user->setPseudo($pseudo);
                $user->setEmail($email);
                $user->setMotDePasse(
                    $hasher->hashPassword($user, $password)
                );
                $user->setVille($ville ?: null);
                $user->setDateInscription(new \DateTime());

                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Compte créé ! Tu peux maintenant te connecter.');
                return $this->redirectToRoute('app_login');
            }
        }

        return $this->render('register/index.html.twig', [
            'error' => $error,
        ]);
    }
}