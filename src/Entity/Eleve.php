<?php

namespace App\Entity;

use App\Repository\EleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EleveRepository::class)]
class Eleve extends Sorcier
{
    /**
     * @var Collection<int, Sortilege>
     */
    #[ORM\ManyToMany(targetEntity: Sortilege::class, inversedBy: 'eleves')]
    private Collection $sortileges;

    #[ORM\ManyToOne(inversedBy: 'eleves')]
    private ?Maison $maison = null;

    /**
     * @var Collection<int, Cours>
     */
    #[ORM\ManyToMany(targetEntity: Cours::class, mappedBy: 'eleves')]
    private Collection $cours;

    /**
     * @var Collection<int, HistoriquePoint>
     */
    #[ORM\OneToMany(targetEntity: HistoriquePoint::class, mappedBy: 'eleve')]
    private Collection $historiquePoints;

    public function __construct()
    {
        $this->sortileges = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->historiquePoints = new ArrayCollection();
    }

    /**
     * @return Collection<int, Sortilege>
     */
    public function getSortileges(): Collection
    {
        return $this->sortileges;
    }

    public function addSortilege(Sortilege $sortilege): static
    {
        if (!$this->sortileges->contains($sortilege)) {
            $this->sortileges->add($sortilege);
            $sortilege->addElefe($this);
        }

        return $this;
    }

    public function removeSortilege(Sortilege $sortilege): static
    {
        if ($this->sortileges->removeElement($sortilege)) {
            $sortilege->removeElefe($this);
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
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        $this->cours->removeElement($cour);

        return $this;
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
            $historiquePoint->setEleve($this);
        }

        return $this;
    }

    public function removeHistoriquePoint(HistoriquePoint $historiquePoint): static
    {
        if ($this->historiquePoints->removeElement($historiquePoint)) {
            // set the owning side to null (unless already changed)
            if ($historiquePoint->getEleve() === $this) {
                $historiquePoint->setEleve(null);
            }
        }

        return $this;
    }
}
