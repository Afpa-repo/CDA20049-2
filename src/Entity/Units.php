<?php

namespace App\Entity;

use App\Repository\UnitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UnitsRepository::class)
 */
class Units
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
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=IngredientRecipe::class, mappedBy="unit")
     */
    private $RelatedIngredients;

    public function __construct()
    {
        $this->RelatedIngredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|IngredientRecipe[]
     */
    public function getRelatedIngredients(): Collection
    {
        return $this->RelatedIngredients;
    }

    public function addRelatedIngredient(IngredientRecipe $relatedIngredient): self
    {
        if (!$this->RelatedIngredients->contains($relatedIngredient)) {
            $this->RelatedIngredients[] = $relatedIngredient;
            $relatedIngredient->setUnit($this);
        }

        return $this;
    }

    public function removeRelatedIngredient(IngredientRecipe $relatedIngredient): self
    {
        if ($this->RelatedIngredients->removeElement($relatedIngredient)) {
            // set the owning side to null (unless already changed)
            if ($relatedIngredient->getUnit() === $this) {
                $relatedIngredient->setUnit(null);
            }
        }

        return $this;
    }
}
