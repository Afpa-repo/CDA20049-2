<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentsRepository::class)
 */
class Comments
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
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity=ingredients::class)
     */
    private $idIngredient;

    /**
     * @ORM\ManyToOne(targetEntity=recipes::class, inversedBy="relatedComments")
     */
    private $idRecipe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

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

    public function getIdRecipe(): ?recipes
    {
        return $this->idRecipe;
    }

    public function setIdRecipe(?recipes $idRecipe): self
    {
        $this->idRecipe = $idRecipe;

        return $this;
    }
}
