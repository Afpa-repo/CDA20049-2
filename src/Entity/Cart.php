<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=CartItems::class, mappedBy="idCart", orphanRemoval=true)
     */
    private $relatedCartItems;

    /**
     * @ORM\OneToOne(targetEntity=Orders::class, mappedBy="cart", cascade={"persist", "remove"})
     */
    private $relatedOrder;

    public function __construct()
    {
        $this->relatedCartItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|CartItems[]
     */
    public function getRelatedCartItems(): Collection
    {
        return $this->relatedCartItems;
    }

    public function addRelatedCartItem(CartItems $relatedCartItem): self
    {
        if (!$this->relatedCartItems->contains($relatedCartItem)) {
            $this->relatedCartItems[] = $relatedCartItem;
            $relatedCartItem->setIdCart($this);
        }

        return $this;
    }

    public function removeRelatedCartItem(CartItems $relatedCartItem): self
    {
        if ($this->relatedCartItems->removeElement($relatedCartItem)) {
            // set the owning side to null (unless already changed)
            if ($relatedCartItem->getIdCart() === $this) {
                $relatedCartItem->setIdCart(null);
            }
        }

        return $this;
    }

    public function getRelatedOrder(): ?Orders
    {
        return $this->relatedOrder;
    }

    public function setRelatedOrder(?Orders $relatedOrder): self
    {
        $this->relatedOrder = $relatedOrder;

        // set (or unset) the owning side of the relation if necessary
        $newCart = null === $relatedOrder ? null : $this;
        if ($relatedOrder->getCart() !== $newCart) {
            $relatedOrder->setCart($newCart);
        }

        return $this;
    }
}
