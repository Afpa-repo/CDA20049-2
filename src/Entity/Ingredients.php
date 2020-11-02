<?php

namespace App\Entity;

use App\Repository\IngredientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientsRepository::class)
 */
class Ingredients
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tempMin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tempMax;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shelfLife;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\OneToMany(targetEntity=CartItems::class, mappedBy="idIngredient")
     */
    private $relatedCartItems;

    /**
     * @ORM\OneToMany(targetEntity=GroceryList::class, mappedBy="idIngredient", orphanRemoval=true)
     */
    private $relatedGroceryLists;

    /**
     * @ORM\ManyToOne(targetEntity=IngredientRecipe::class, inversedBy="RelatedIngredients")
     */
    private $Category;

    /**
     * @ORM\OneToMany(targetEntity=Favorites::class, mappedBy="ingredient")
     */
    private $favorites;

    public function __construct()
    {
        $this->relatedCartItems = new ArrayCollection();
        $this->relatedGroceryLists = new ArrayCollection();
        $this->favorites = new ArrayCollection();
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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTempMin(): ?int
    {
        return $this->tempMin;
    }

    public function setTempMin(?int $tempMin): self
    {
        $this->tempMin = $tempMin;

        return $this;
    }

    public function getTempMax(): ?int
    {
        return $this->tempMax;
    }

    public function setTempMax(?int $tempMax): self
    {
        $this->tempMax = $tempMax;

        return $this;
    }

    public function getShelfLife(): ?int
    {
        return $this->shelfLife;
    }

    public function setShelfLife(?int $shelfLife): self
    {
        $this->shelfLife = $shelfLife;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
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
            $relatedCartItem->setIdIngredient($this);
        }

        return $this;
    }

    public function removeRelatedCartItem(CartItems $relatedCartItem): self
    {
        if ($this->relatedCartItems->removeElement($relatedCartItem)) {
            // set the owning side to null (unless already changed)
            if ($relatedCartItem->getIdIngredient() === $this) {
                $relatedCartItem->setIdIngredient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GroceryList[]
     */
    public function getRelatedGroceryLists(): Collection
    {
        return $this->relatedGroceryLists;
    }

    public function addRelatedGroceryList(GroceryList $relatedGroceryList): self
    {
        if (!$this->relatedGroceryLists->contains($relatedGroceryList)) {
            $this->relatedGroceryLists[] = $relatedGroceryList;
            $relatedGroceryList->setIdIngredient($this);
        }

        return $this;
    }

    public function removeRelatedGroceryList(GroceryList $relatedGroceryList): self
    {
        if ($this->relatedGroceryLists->removeElement($relatedGroceryList)) {
            // set the owning side to null (unless already changed)
            if ($relatedGroceryList->getIdIngredient() === $this) {
                $relatedGroceryList->setIdIngredient(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?IngredientRecipe
    {
        return $this->Category;
    }

    public function setCategory(?IngredientRecipe $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    /**
     * @return Collection|Favorites[]
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Favorites $favorite): self
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites[] = $favorite;
            $favorite->setIngredient($this);
        }

        return $this;
    }

    public function removeFavorite(Favorites $favorite): self
    {
        if ($this->favorites->removeElement($favorite)) {
            // set the owning side to null (unless already changed)
            if ($favorite->getIngredient() === $this) {
                $favorite->setIngredient(null);
            }
        }

        return $this;
    }
}
