<?php

namespace App\Entity;

use App\Repository\WishListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WishListRepository::class)]
class WishList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'wishlist', targetEntity: WishListProduct::class, orphanRemoval: true)]
    private $wishListProducts;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'wishLists')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    public function __construct()
    {
        $this->wishListProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|WishListProduct[]
     */
    public function getWishListProducts(): Collection
    {
        return $this->wishListProducts;
    }

    public function addWishListProduct(WishListProduct $wishListProduct): self
    {
        if (!$this->wishListProducts->contains($wishListProduct)) {
            $this->wishListProducts[] = $wishListProduct;
            $wishListProduct->setWishlist($this);
        }

        return $this;
    }

    public function removeWishListProduct(WishListProduct $wishListProduct): self
    {
        if ($this->wishListProducts->removeElement($wishListProduct)) {
            // set the owning side to null (unless already changed)
            if ($wishListProduct->getWishlist() === $this) {
                $wishListProduct->setWishlist(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
