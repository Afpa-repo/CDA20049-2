<?php

namespace App\Entity;

use App\Repository\CartItemsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartItemsRepository::class)
 */
class CartItems
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $Quantity;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $PriceWhenBought;

    /**
     * @ORM\ManyToOne(targetEntity=ingredients::class, inversedBy="relatedCartItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idIngredient;

    /**
     * @ORM\ManyToOne(targetEntity=Cart::class, inversedBy="relatedCartItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCart;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getPriceWhenBought(): ?string
    {
        return $this->PriceWhenBought;
    }

    public function setPriceWhenBought(string $PriceWhenBought): self
    {
        $this->PriceWhenBought = $PriceWhenBought;

        return $this;
    }

    public function getIdIngredient(): ?ingredients
    {
        return $this->idIngredient;
    }

    public function setIdIngredient(?ingredients $idIngredient): self
    {
        $this->idIngredient = $idIngredient;

        return $this;
    }

    public function getIdCart(): ?cart
    {
        return $this->idCart;
    }

    public function setIdCart(?cart $idCart): self
    {
        $this->idCart = $idCart;

        return $this;
    }
}
