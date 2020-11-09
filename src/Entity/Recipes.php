<?php

namespace App\Entity;

use App\Repository\RecipesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipesRepository::class)
 */
class Recipes
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
    private $idAuthor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     *  @ORM\Column(type="json", nullable=true)
     */
    private $instructions;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="idRecipe")
     */
    private $relatedComments;

    /**
     * @ORM\ManyToOne(targetEntity=RecipeCategory::class, inversedBy="relatedRecipes", fetch="EAGER")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=Users::class, mappedBy="favoredRecipes")
     */
    private $UsersFavorite;

    /**
     * @ORM\OneToMany(targetEntity=IngredientRecipe::class, mappedBy="recipe",fetch="EAGER")
     */
    private $ingredients;


    public function __construct()
    {
        $this->relatedComments = new ArrayCollection();
        $this->UsersFavorite = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAuthor(): ?int
    {
        return $this->idAuthor;
    }

    public function setIdAuthor(int $idAuthor): self
    {
        $this->idAuthor = $idAuthor;

        return $this;
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
     * @return Collection|Comments[]
     */
    public function getRelatedComments(): Collection
    {
        return $this->relatedComments;
    }

    public function addRelatedComment(Comments $relatedComment): self
    {
        if (!$this->relatedComments->contains($relatedComment)) {
            $this->relatedComments[] = $relatedComment;
            $relatedComment->setIdRecipe($this);
        }

        return $this;
    }

    public function removeRelatedComment(Comments $relatedComment): self
    {
        if ($this->relatedComments->removeElement($relatedComment)) {
            // set the owning side to null (unless already changed)
            if ($relatedComment->getIdRecipe() === $this) {
                $relatedComment->setIdRecipe(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?RecipeCategory
    {
        return $this->category;
    }

    public function setCategory(?RecipeCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getInstructions(): array
    {
        $instructions = $this->instructions;

        $instructions[] = 'éplucher, cuire, touiller?!';


        return array_unique($instructions);
    }

    public function setInstructions(array $instructions): self
    {
        $this->instructions = $instructions;

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
            $usersFavorite->addFavoredRecipe($this);
        }

        return $this;
    }

    public function removeUsersFavorite(Users $usersFavorite): self
    {
        if ($this->UsersFavorite->removeElement($usersFavorite)) {
            $usersFavorite->removeFavoredRecipe($this);
        }

        return $this;
    }

    /**
     * @return Collection|IngredientRecipe[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(IngredientRecipe $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
            $ingredient->setRecipe($this);
        }

        return $this;
    }

    public function removeIngredient(IngredientRecipe $ingredient): self
    {
        if ($this->ingredients->removeElement($ingredient)) {
            // set the owning side to null (unless already changed)
            if ($ingredient->getRecipe() === $this) {
                $ingredient->setRecipe(null);
            }
        }

        return $this;
    }
}
