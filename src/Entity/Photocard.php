<?php

namespace App\Entity;

use App\Repository\PhotocardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotocardRepository::class)]
class Photocard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $raretes = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $nom_set = null;

    /**
     * @var Collection<int, AlbumVersion>
     */
    #[ORM\ManyToMany(targetEntity: AlbumVersion::class, inversedBy: 'photocards')]
    private Collection $versions;

    /**
     * @var Collection<int, Idol>
     */
    #[ORM\ManyToMany(targetEntity: Idol::class, inversedBy: 'photocards')]
    private Collection $idols;

    /**
     * @var Collection<int, UserCollection>
     */
    #[ORM\OneToMany(targetEntity: UserCollection::class, mappedBy: 'photocard')]
    private Collection $collections;

    /**
     * @var Collection<int, Wishlist>
     */
    #[ORM\OneToMany(targetEntity: Wishlist::class, mappedBy: 'photocard')]
    private Collection $wishlists;

    public function __construct()
    {
        $this->versions = new ArrayCollection();
        $this->idols = new ArrayCollection();
        $this->collections = new ArrayCollection();
        $this->wishlists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getRaretes(): ?string
    {
        return $this->raretes;
    }

    public function setRaretes(?string $raretes): static
    {
        $this->raretes = $raretes;

        return $this;
    }

    public function getNomSet(): ?string
    {
        return $this->nom_set;
    }

    public function setNomSet(?string $nom_set): static
    {
        $this->nom_set = $nom_set;

        return $this;
    }

    /**
     * @return Collection<int, AlbumVersion>
     */
    public function getVersions(): Collection
    {
        return $this->versions;
    }

    public function addVersion(AlbumVersion $version): static
    {
        if (!$this->versions->contains($version)) {
            $this->versions->add($version);
        }

        return $this;
    }

    public function removeVersion(AlbumVersion $version): static
    {
        $this->versions->removeElement($version);

        return $this;
    }

    /**
     * @return Collection<int, Idol>
     */
    public function getIdols(): Collection
    {
        return $this->idols;
    }

    public function addIdol(Idol $idol): static
    {
        if (!$this->idols->contains($idol)) {
            $this->idols->add($idol);
        }

        return $this;
    }

    public function removeIdol(Idol $idol): static
    {
        $this->idols->removeElement($idol);

        return $this;
    }

    /**
     * @return Collection<int, UserCollection>
     */
    public function getCollections(): Collection
    {
        return $this->collections;
    }

    public function addCollection(UserCollection $collection): static
    {
        if (!$this->collections->contains($collection)) {
            $this->collections->add($collection);
            $collection->setPhotocard($this);
        }

        return $this;
    }

    public function removeCollection(UserCollection $collection): static
    {
        if ($this->collections->removeElement($collection)) {
            // set the owning side to null (unless already changed)
            if ($collection->getPhotocard() === $this) {
                $collection->setPhotocard(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Wishlist>
     */
    public function getWishlists(): Collection
    {
        return $this->wishlists;
    }

    public function addWishlist(Wishlist $wishlist): static
    {
        if (!$this->wishlists->contains($wishlist)) {
            $this->wishlists->add($wishlist);
            $wishlist->setPhotocard($this);
        }

        return $this;
    }

    public function removeWishlist(Wishlist $wishlist): static
    {
        if ($this->wishlists->removeElement($wishlist)) {
            // set the owning side to null (unless already changed)
            if ($wishlist->getPhotocard() === $this) {
                $wishlist->setPhotocard(null);
            }
        }

        return $this;
    }
}
