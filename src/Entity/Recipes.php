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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idCategory;

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

    public function __construct()
    {
        $this->relatedComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCategory(): ?int
    {
        return $this->idCategory;
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
}
