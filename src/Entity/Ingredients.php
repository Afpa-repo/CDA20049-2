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
     * @ORM\ManyToOne(targetEntity=IngredientCategory::class, inversedBy="RelatedIngredients")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=Origin::class, inversedBy="relatedIngredients")
     */
    private $origin;

    /**
     * @ORM\ManyToMany(targetEntity=Users::class, mappedBy="favoredIngredients")
     */
    private $UsersFavorite;

    /**
     * @ORM\OneToMany(targetEntity=IngredientRecipe::class, mappedBy="ingredient")
     */
    private $recipes;

    /**
     * @ORM\ManyToOne(targetEntity=Units::class)
     */
    private $unit;

    public function __construct()
    {
        $this->relatedCartItems = new ArrayCollection();
        $this->relatedGroceryLists = new ArrayCollection();
        $this->UsersFavorite = new ArrayCollection();
        $this->recipes = new ArrayCollection();
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


    public function getCategory(): ?IngredientCategory
    {
        return $this->category;
    }

    public function setCategory(?IngredientCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Recipes[]
     */
    public function getIngRec(): Collection
    {
        return $this->IngRec;
    }

    public function addIngRec(Recipes $ingRec): self
    {
        if (!$this->IngRec->contains($ingRec)) {
            $this->IngRec[] = $ingRec;
        }

        return $this;
    }

    public function removeIngRec(Recipes $ingRec): self
    {
        $this->IngRec->removeElement($ingRec);

        return $this;
    }

    public function getOrigin(): ?Origin
    {
        return $this->origin;
    }

    public function setOrigin(?Origin $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * @return Collection|Users[]
     */
    public function getUsersFavorite(): Collection
    {
        return $this->UsersFavorite;
    }

    public function addUsersFavorite(Users $usersFavorite): self
    {
        if (!$this->UsersFavorite->contains($usersFavorite)) {
            $this->UsersFavorite[] = $usersFavorite;
            $usersFavorite->addFavoredIngredient($this);
        }

        return $this;
    }

    public function removeUsersFavorite(Users $usersFavorite): self
    {
        if ($this->UsersFavorite->removeElement($usersFavorite)) {
            $usersFavorite->removeFavoredIngredient($this);
        }

        return $this;
    }

    /**
     * @return Collection|IngredientRecipe[]
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(IngredientRecipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
            $recipe->setIngredient($this);
        }

        return $this;
    }

    public function removeRecipe(IngredientRecipe $recipe): self
    {
        if ($this->recipes->removeElement($recipe)) {
            // set the owning side to null (unless already changed)
            if ($recipe->getIngredient() === $this) {
                $recipe->setIngredient(null);
            }
        }

        return $this;
    }

    public function getUnit(): ?Units
    {
        return $this->unit;
    }

    public function setUnit(?Units $unit): self
    {
        $this->unit = $unit;

        return $this;
    }
}
