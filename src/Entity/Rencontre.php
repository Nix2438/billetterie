<?php

namespace App\Entity;

use App\Repository\RencontreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, Billet>
     */
    #[ORM\OneToMany(targetEntity: Billet::class, mappedBy: 'rencontre')]
    private Collection $billets;

    public function __construct()
    {
        $this->billets = new ArrayCollection();
    }
public function getPlacesRestantes(): int
{
    return $this->placesEnVente - count($this->billets);
}

public function isComplet(): bool
{
    return $this->getPlacesRestantes() <= 0;
}
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

    /**
     * @return Collection<int, Billet>
     */
    public function getBillets(): Collection
    {
        return $this->billets;
    }

    public function addBillet(Billet $billet): static
    {
        if (!$this->billets->contains($billet)) {
            $this->billets->add($billet);
            $billet->setRencontre($this);
        }

        return $this;
    }

    public function removeBillet(Billet $billet): static
    {
        if ($this->billets->removeElement($billet)) {
            // set the owning side to null (unless already changed)
            if ($billet->getRencontre() === $this) {
                $billet->setRencontre(null);
            }
        }

        return $this;
    }
}
