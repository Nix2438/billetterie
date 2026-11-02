<?php

namespace App\Entity;

use App\Repository\ClubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClubRepository::class)]
class Club
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $ville = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\ManyToOne(inversedBy: 'clubs')]
    private ?Stade $stade = null;

    /**
     * @var Collection<int, Rencontre>
     */
    #[ORM\OneToMany(targetEntity: Rencontre::class, mappedBy: 'clubDomicile')]
    private Collection $rencontresDomicile;

    /**
     * @var Collection<int, Rencontre>
     */
    #[ORM\OneToMany(targetEntity: Rencontre::class, mappedBy: 'clubExterieur')]
    private Collection $rencontresExterieur;

    public function __construct()
    {
        $this->rencontresDomicile = new ArrayCollection();
        $this->rencontresExterieur = new ArrayCollection();
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

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

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
     * @return Collection<int, Rencontre>
     */
    public function getRencontresDomicile(): Collection
    {
        return $this->rencontresDomicile;
    }

    public function addRencontresDomicile(Rencontre $rencontresDomicile): static
    {
        if (!$this->rencontresDomicile->contains($rencontresDomicile)) {
            $this->rencontresDomicile->add($rencontresDomicile);
            $rencontresDomicile->setClubDomicile($this);
        }

        return $this;
    }

    public function removeRencontresDomicile(Rencontre $rencontresDomicile): static
    {
        if ($this->rencontresDomicile->removeElement($rencontresDomicile)) {
            // set the owning side to null (unless already changed)
            if ($rencontresDomicile->getClubDomicile() === $this) {
                $rencontresDomicile->setClubDomicile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rencontre>
     */
    public function getRencontresExterieur(): Collection
    {
        return $this->rencontresExterieur;
    }

    public function addRencontresExterieur(Rencontre $rencontresExterieur): static
    {
        if (!$this->rencontresExterieur->contains($rencontresExterieur)) {
            $this->rencontresExterieur->add($rencontresExterieur);
            $rencontresExterieur->setClubExterieur($this);
        }

        return $this;
    }

    public function removeRencontresExterieur(Rencontre $rencontresExterieur): static
    {
        if ($this->rencontresExterieur->removeElement($rencontresExterieur)) {
            // set the owning side to null (unless already changed)
            if ($rencontresExterieur->getClubExterieur() === $this) {
                $rencontresExterieur->setClubExterieur(null);
            }
        }

        return $this;
    }
}