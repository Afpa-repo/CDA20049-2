<?php

namespace App\Entity;

use App\Repository\RecipeCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeCategoryRepository::class)
 */
class RecipeCategory
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
     * @ORM\OneToMany(targetEntity=Recipes::class, mappedBy="category")
     */
    private $relatedRecipes;

    public function __construct()
    {
        $this->relatedRecipes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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
     * @return Collection|Recipes[]
     */
    public function getRelatedRecipes(): Collection
    {
        return $this->relatedRecipes;
    }

    public function addRelatedRecipe(Recipes $relatedRecipe): self
    {
        if (!$this->relatedRecipes->contains($relatedRecipe)) {
            $this->relatedRecipes[] = $relatedRecipe;
            $relatedRecipe->setCategory($this);
        }

        return $this;
    }

    public function removeRelatedRecipe(Recipes $relatedRecipe): self
    {
        if ($this->relatedRecipes->removeElement($relatedRecipe)) {
            // set the owning side to null (unless already changed)
            if ($relatedRecipe->getCategory() === $this) {
                $relatedRecipe->setCategory(null);
            }
        }

        return $this;
    }
}
