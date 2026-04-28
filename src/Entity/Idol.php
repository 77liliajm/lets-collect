<?php

namespace App\Entity;

use App\Repository\IdolRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IdolRepository::class)]
class Idol
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom_scene = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $date_naissance = null;

    /**
     * @var Collection<int, Photocard>
     */
    #[ORM\ManyToMany(targetEntity: Photocard::class, mappedBy: 'idols')]
    private Collection $photocards;

    public function __construct()
    {
        $this->photocards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomScene(): ?string
    {
        return $this->nom_scene;
    }

    public function setNomScene(string $nom_scene): static
    {
        $this->nom_scene = $nom_scene;

        return $this;
    }

    public function getDateNaissance(): ?\DateTime
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(?\DateTime $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    /**
     * @return Collection<int, Photocard>
     */
    public function getPhotocards(): Collection
    {
        return $this->photocards;
    }

    public function addPhotocard(Photocard $photocard): static
    {
        if (!$this->photocards->contains($photocard)) {
            $this->photocards->add($photocard);
            $photocard->addIdol($this);
        }

        return $this;
    }

    public function removePhotocard(Photocard $photocard): static
    {
        if ($this->photocards->removeElement($photocard)) {
            $photocard->removeIdol($this);
        }

        return $this;
    }
}
