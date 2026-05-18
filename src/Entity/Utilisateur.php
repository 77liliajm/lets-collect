<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $mot_de_passe = null;

    #[ORM\Column]
    private ?\DateTime $date_inscription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo_profil = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $ville = null;

    #[ORM\OneToMany(targetEntity: UserCollection::class, mappedBy: 'utilisateur')]
    private Collection $collections;

    #[ORM\OneToMany(targetEntity: Wishlist::class, mappedBy: 'utilisateur')]
    private Collection $wishlists;

    #[ORM\OneToMany(targetEntity: Echange::class, mappedBy: 'proposant')]
    private Collection $echangesPropose;

    #[ORM\OneToMany(targetEntity: Echange::class, mappedBy: 'receveur')]
    private Collection $echangesRecu;

    public function __construct()
    {
        $this->collections = new ArrayCollection();
        $this->wishlists = new ArrayCollection();
        $this->echangesPropose = new ArrayCollection();
        $this->echangesRecu = new ArrayCollection();
    }

    // ── UserInterface ──────────────────────────────────────────────
    public function getUserIdentifier(): string { return (string) $this->email; }
    public function getRoles(): array { return ['ROLE_USER']; }
    public function getPassword(): string { return (string) $this->mot_de_passe; }
    public function eraseCredentials(): void {}

    // ── Getters / Setters ──────────────────────────────────────────
    public function getId(): ?int { return $this->id; }

    public function getPseudo(): ?string { return $this->pseudo; }
    public function setPseudo(string $pseudo): static { $this->pseudo = $pseudo; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): static { $this->email = $email; return $this; }

    public function getMotDePasse(): ?string { return $this->mot_de_passe; }
    public function setMotDePasse(string $mot_de_passe): static { $this->mot_de_passe = $mot_de_passe; return $this; }

    public function getDateInscription(): ?\DateTime { return $this->date_inscription; }
    public function setDateInscription(\DateTime $date_inscription): static { $this->date_inscription = $date_inscription; return $this; }

    public function getPhotoProfil(): ?string { return $this->photo_profil; }
    public function setPhotoProfil(?string $photo_profil): static { $this->photo_profil = $photo_profil; return $this; }

    public function getVille(): ?string { return $this->ville; }
    public function setVille(?string $ville): static { $this->ville = $ville; return $this; }

    public function getCollections(): Collection { return $this->collections; }
    public function addCollection(UserCollection $collection): static
    {
        if (!$this->collections->contains($collection)) {
            $this->collections->add($collection);
            $collection->setUtilisateur($this);
        }
        return $this;
    }
    public function removeCollection(UserCollection $collection): static
    {
        if ($this->collections->removeElement($collection)) {
            if ($collection->getUtilisateur() === $this) $collection->setUtilisateur(null);
        }
        return $this;
    }

    public function getWishlists(): Collection { return $this->wishlists; }
    public function addWishlist(Wishlist $wishlist): static
    {
        if (!$this->wishlists->contains($wishlist)) {
            $this->wishlists->add($wishlist);
            $wishlist->setUtilisateur($this);
        }
        return $this;
    }
    public function removeWishlist(Wishlist $wishlist): static
    {
        if ($this->wishlists->removeElement($wishlist)) {
            if ($wishlist->getUtilisateur() === $this) $wishlist->setUtilisateur(null);
        }
        return $this;
    }

    public function getEchangesPropose(): Collection { return $this->echangesPropose; }
    public function addEchangesPropose(Echange $e): static
    {
        if (!$this->echangesPropose->contains($e)) {
            $this->echangesPropose->add($e);
            $e->setProposant($this);
        }
        return $this;
    }
    public function removeEchangesPropose(Echange $e): static
    {
        if ($this->echangesPropose->removeElement($e)) {
            if ($e->getProposant() === $this) $e->setProposant(null);
        }
        return $this;
    }

    public function getEchangesRecu(): Collection { return $this->echangesRecu; }
    public function addEchangesRecu(Echange $e): static
    {
        if (!$this->echangesRecu->contains($e)) {
            $this->echangesRecu->add($e);
            $e->setReceveur($this);
        }
        return $this;
    }
    public function removeEchangesRecu(Echange $e): static
    {
        if ($this->echangesRecu->removeElement($e)) {
            if ($e->getReceveur() === $this) $e->setReceveur(null);
        }
        return $this;
    }
}