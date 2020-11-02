<?php

namespace App\Entity;

use App\Repository\FavoritesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FavoritesRepository::class)
 */
class Favorites
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=recipes::class, inversedBy="ingredient")
     */
    private $recipe;

    /**
     * @ORM\ManyToOne(targetEntity=ingredients::class, inversedBy="favorites")
     */
    private $ingredient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipe(): ?recipes
    {
        return $this->recipe;
    }

    public function setRecipe(?recipes $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getIngredient(): ?ingredients
    {
        return $this->ingredient;
    }

    public function setIngredient(?ingredients $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
    }
}
