<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Le nom doit comporter au moins {{ limit }} caractères.',
        maxMessage: 'Le nom ne peut pas dépasser {{ limit }} caractères.'
    )]
    private ?string $nom = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Positive(message: 'Le prix au kilo doit être un nombre positif.')]
    #[Assert\LessThan(
        value: 200,
        message: 'Le prix au kilo ne peut pas dépasser 200 euros.'
    )]
    private ?float $prixAuKilo = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?\DateTimeImmutable $dateCreation = null;

    public function __construct()
    {
        $this->dateCreation = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrixAuKilo(): ?float
    {
        return $this->prixAuKilo;
    }

    public function setPrixAuKilo(float $prixAuKilo): static
    {
        $this->prixAuKilo = $prixAuKilo;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeImmutable
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeImmutable $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }
}
