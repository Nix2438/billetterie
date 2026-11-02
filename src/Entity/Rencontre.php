<?php

namespace App\Entity;

use App\Repository\RencontreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RencontreRepository::class)]
class Rencontre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    private ?string $prix = null;

    #[ORM\Column]
    private ?int $placesEnVente = null;

    #[ORM\ManyToOne(inversedBy: 'rencontresDomicile')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Club $clubDomicile = null;

    #[ORM\ManyToOne(inversedBy: 'rencontresExterieur')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Club $clubExterieur = null;

    #[ORM\ManyToOne(inversedBy: 'rencontres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Stade $stade = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPlacesEnVente(): ?int
    {
        return $this->placesEnVente;
    }

    public function setPlacesEnVente(int $placesEnVente): static
    {
        $this->placesEnVente = $placesEnVente;

        return $this;
    }

    public function getClubDomicile(): ?Club
    {
        return $this->clubDomicile;
    }

    public function setClubDomicile(?Club $clubDomicile): static
    {
        $this->clubDomicile = $clubDomicile;

        return $this;
    }

    public function getClubExterieur(): ?Club
    {
        return $this->clubExterieur;
    }

    public function setClubExterieur(?Club $clubExterieur): static
    {
        $this->clubExterieur = $clubExterieur;

        return $this;
    }

    public function getStade(): ?Stade
    {
        return $this->stade;
    }

    public function setStade(?Stade $stade): static
    {
        $this->stade = $stade;

        return $this;
    }
}
