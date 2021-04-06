<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModeleRepository")
 */
class Modele
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="float")
     */
    private $tarifKmSupplementaire;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPlaces;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $vitesseMax;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

   

    public function __construct()
    {
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTarifKmSupplementaire(): ?float
    {
        return $this->tarifKmSupplementaire;
    }

    public function setTarifKmSupplementaire(float $tarifKmSupplementaire): self
    {
        $this->tarifKmSupplementaire = $tarifKmSupplementaire;

        return $this;
    }

    public function getNbPlaces(): ?int
    {
        return $this->nbPlaces;
    }

    public function setNbPlaces(int $nbPlaces): self
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    public function getVitesseMax(): ?float
    {
        return $this->vitesseMax;
    }

    public function setVitesseMax(?float $vitesseMax): self
    {
        $this->vitesseMax = $vitesseMax;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

   
}
