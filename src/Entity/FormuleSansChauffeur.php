<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormuleSansChauffeurRepository")
 */
class FormuleSansChauffeur extends Formule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbKmInclus;
  
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tarification", mappedBy="laFormuleSC", orphanRemoval=true)
     */
    private $lesTarifications;

    public function __construct()
    {
        $this->lesTarifications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getNbKmInclus(): ?int
    {
        return $this->nbKmInclus;
    }

    public function setNbKmInclus(int $nbKmInclus): self
    {
        $this->nbKmInclus = $nbKmInclus;

        return $this;
    }

   


    /**
     * @return Collection|Tarification[]
     */
    public function getLesTarifications(): Collection
    {
        return $this->lesTarifications;
    }

    public function addLesTarification(Tarification $lesTarification): self
    {
        if (!$this->lesTarifications->contains($lesTarification)) {
            $this->lesTarifications[] = $lesTarification;
            $lesTarification->setLaFormuleSC($this);
        }

        return $this;
    }

    public function removeLesTarification(Tarification $lesTarification): self
    {
        if ($this->lesTarifications->contains($lesTarification)) {
            $this->lesTarifications->removeElement($lesTarification);
            // set the owning side to null (unless already changed)
            if ($lesTarification->getLaFormuleSC() === $this) {
                $lesTarification->setLaFormuleSC(null);
            }
        }

        return $this;
    }
}
