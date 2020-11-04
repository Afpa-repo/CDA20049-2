<?php

namespace App\Entity;

use App\Repository\OriginRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OriginRepository::class)
 */
class Origin
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
    private $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $region;

    /**
     * @ORM\OneToMany(targetEntity=Ingredients::class, mappedBy="origin")
     */
    private $relatedIngredients;

    public function __construct()
    {
        $this->relatedIngredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection|Ingredients[]
     */
    public function getRelatedIngredients(): Collection
    {
        return $this->relatedIngredients;
    }

    public function addRelatedIngredient(Ingredients $relatedIngredient): self
    {
        if (!$this->relatedIngredients->contains($relatedIngredient)) {
            $this->relatedIngredients[] = $relatedIngredient;
            $relatedIngredient->setOrigin($this);
        }

        return $this;
    }

    public function removeRelatedIngredient(Ingredients $relatedIngredient): self
    {
        if ($this->relatedIngredients->removeElement($relatedIngredient)) {
            // set the owning side to null (unless already changed)
            if ($relatedIngredient->getOrigin() === $this) {
                $relatedIngredient->setOrigin(null);
            }
        }

        return $this;
    }
}
