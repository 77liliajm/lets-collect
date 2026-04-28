<?php

namespace App\Entity;

use App\Repository\EchangeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EchangeRepository::class)]
class Echange
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $statut = null;

    #[ORM\Column]
    private ?\DateTime $date_creation = null;

    #[ORM\ManyToOne(inversedBy: 'echangesPropose')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $proposant = null;

    #[ORM\ManyToOne(inversedBy: 'echangesRecu')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $receveur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getDateCreation(): ?\DateTime
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTime $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getProposant(): ?Utilisateur
    {
        return $this->proposant;
    }

    public function setProposant(?Utilisateur $proposant): static
    {
        $this->proposant = $proposant;

        return $this;
    }

    public function getReceveur(): ?Utilisateur
    {
        return $this->receveur;
    }

    public function setReceveur(?Utilisateur $receveur): static
    {
        $this->receveur = $receveur;

        return $this;
    }
}
