<?php

namespace App\Entity;

use App\Repository\ProfesseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProfesseurRepository::class)]
class Professeur extends Sorcier
{
    /**
     * @var Collection<int, HistoriquePoint>
     */
    #[ORM\OneToMany(targetEntity: HistoriquePoint::class, mappedBy: 'professeur')]
    private Collection $historiquePoints;

    #[ORM\OneToOne(mappedBy: 'professeur', cascade: ['persist', 'remove'])]
    private ?Maison $maison = null;

    /**
     * @var Collection<int, Cours>
     */
    #[ORM\OneToMany(targetEntity: Cours::class, mappedBy: 'professeur')]
    private Collection $cours;

    public function __construct()
    {
        $this->historiquePoints = new ArrayCollection();
        $this->cours = new ArrayCollection();
    }

    /**
     * @return Collection<int, HistoriquePoint>
     */
    public function getHistoriquePoints(): Collection
    {
        return $this->historiquePoints;
    }

    public function addHistoriquePoint(HistoriquePoint $historiquePoint): static
    {
        if (!$this->historiquePoints->contains($historiquePoint)) {
            $this->historiquePoints->add($historiquePoint);
            $historiquePoint->setProfesseur($this);
        }

        return $this;
    }

    public function removeHistoriquePoint(HistoriquePoint $historiquePoint): static
    {
        if ($this->historiquePoints->removeElement($historiquePoint)) {
            // set the owning side to null (unless already changed)
            if ($historiquePoint->getProfesseur() === $this) {
                $historiquePoint->setProfesseur(null);
            }
        }

        return $this;
    }

    public function getMaison(): ?Maison
    {
        return $this->maison;
    }

    public function setMaison(?Maison $maison): static
    {
        $this->maison = $maison;

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): static
    {
        if (!$this->cours->contains($cour)) {
            $this->cours->add($cour);
            $cour->setProfesseur($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getProfesseur() === $this) {
                $cour->setProfesseur(null);
            }
        }

        return $this;
    }
}
