<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VehiculeRepository")
 */
class Vehicule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $immatriculation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateAchat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Modele")
     * @ORM\JoinColumn(nullable=false)
     */
    private $leModele;

    /**
     * @ORM\Column(type="integer")
     */
    private $Km_supp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(?\DateTimeInterface $dateAchat): self
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    public function getLeModele(): ?Modele
    {
        return $this->leModele;
    }

    public function setLeModele(?Modele $leModele): self
    {
        $this->leModele = $leModele;

        return $this;
    }

    public function getKmSupp(): ?int
    {
        return $this->Km_supp;
    }

    public function setKmSupp(int $Km_supp): self
    {
        $this->Km_supp = $Km_supp;

        return $this;
    }
}
