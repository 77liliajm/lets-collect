<?php

namespace App\Entity;

use App\Repository\AlbumVersionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumVersionRepository::class)]
class AlbumVersion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nom_version = null;

    #[ORM\ManyToOne(inversedBy: 'versions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Album $album = null;

    /**
     * @var Collection<int, Photocard>
     */
    #[ORM\ManyToMany(targetEntity: Photocard::class, mappedBy: 'versions')]
    private Collection $photocards;

    public function __construct()
    {
        $this->photocards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVersion(): ?string
    {
        return $this->nom_version;
    }

    public function setNomVersion(string $nom_version): static
    {
        $this->nom_version = $nom_version;

        return $this;
    }

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): static
    {
        $this->album = $album;

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
            $photocard->addVersion($this);
        }

        return $this;
    }

    public function removePhotocard(Photocard $photocard): static
    {
        if ($this->photocards->removeElement($photocard)) {
            $photocard->removeVersion($this);
        }

        return $this;
    }
}
