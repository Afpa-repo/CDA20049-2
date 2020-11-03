<?php

namespace App\Entity;

use App\Repository\GroceryListRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroceryListRepository::class)
 */
class GroceryList
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
     * @ORM\ManyToOne(targetEntity=Ingredients::class, inversedBy="relatedGroceryLists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idIngredient;

    /**
     * @ORM\OneToOne(targetEntity=Users::class, inversedBy="groceryList", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUser;

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

    public function getIdIngredient(): ?ingredients
    {
        return $this->idIngredient;
    }

    public function setIdIngredient(?ingredients $idIngredient): self
    {
        $this->idIngredient = $idIngredient;

        return $this;
    }

    public function getIdUser(): ?users
    {
        return $this->idUser;
    }

    public function setIdUser(Users $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }
}
