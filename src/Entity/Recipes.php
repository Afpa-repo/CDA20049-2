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
     * @ORM\Column(type="json")
     */
    private $instructions = [];

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="idRecipe")
     */
    private $relatedComments;

    /**
     * @ORM\ManyToOne(targetEntity=RecipeCategory::class, inversedBy="relatedRecipes", fetch="EAGER")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=Favorites::class, mappedBy="recipe")
     */
    private $ingredient;

    public function __construct()
    {
        $this->relatedComments = new ArrayCollection();
        $this->ingredient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }



    public function setIdCategory(?int $idCategory): self
    {
        $this->idCategory = $idCategory;

        return $this;
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

    public function getInstructions(): ?array
    {
        return $this->instructions;
    }

    public function setInstructions(array $instructions): self
    {
        $this->instructions = $instructions;

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

    /**
     * @return Collection|Favorites[]
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Favorites $favorites): self
    {
        if (!$this->favorites->contains($favorites)) {
            $this->favorites[] = $favorites;
            $favorites->setRecipe($this);
        }

        return $this;
    }

    public function removeFavorite(Favorites $favorites): self
    {
        if ($this->favorites->removeElement($favorites)) {
            // set the owning side to null (unless already changed)
            if ($favorites->getRecipe() === $this) {
                $favorites->setRecipe(null);
            }
        }

        return $this;
    }
}
