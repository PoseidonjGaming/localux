<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="location_type", type="string")
 * @ORM\DiscriminatorMap({"location"="Location", "locSC"="LocationSansChauffeur" , "locAC"="LocationAvecChauffeur"})
 */

abstract class Location
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateLocation;

    /**
     * @ORM\Column(type="float")
     */
    private $montantRegle;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateHreDepartPrevu;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateHreDepartReel;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateHreRetourPrevu;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateHreRetourReel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vehicule")
     * @ORM\JoinColumn(nullable=false)
     */
    private $leVehicule;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client")
     * @ORM\JoinColumn(nullable=false)
     */
    private $leClient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLocation(): ?\DateTimeInterface
    {
        return $this->dateLocation;
    }

    public function setDateLocation(\DateTimeInterface $dateLocation): self
    {
        $this->dateLocation = $dateLocation;

        return $this;
    }

    public function getMontantRegle(): ?float
    {
        return $this->montantRegle;
    }

    public function setMontantRegle(float $montantRegle): self
    {
        $this->montantRegle = $montantRegle;

        return $this;
    }

    public function getDateHreDepartPrevu(): ?\DateTimeInterface
    {
        return $this->dateHreDepartPrevu;
    }

    public function setDateHreDepartPrevu(\DateTimeInterface $dateHreDepartPrevu): self
    {
        $this->dateHreDepartPrevu = $dateHreDepartPrevu;

        return $this;
    }

    public function getDateHreDepartReel(): ?\DateTimeInterface
    {
        return $this->dateHreDepartReel;
    }

    public function setDateHreDepartReel(?\DateTimeInterface $dateHreDepartReel): self
    {
        $this->dateHreDepartReel = $dateHreDepartReel;

        return $this;
    }

    public function getDateHreRetourPrevu(): ?\DateTimeInterface
    {
        return $this->dateHreRetourPrevu;
    }

    public function setDateHreRetourPrevu(\DateTimeInterface $dateHreRetourPrevu): self
    {
        $this->dateHreRetourPrevu = $dateHreRetourPrevu;

        return $this;
    }

    public function getDateHreRetourReel(): ?\DateTimeInterface
    {
        return $this->dateHreRetourReel;
    }

    public function setDateHreRetourReel(?\DateTimeInterface $dateHreRetourReel): self
    {
        $this->dateHreRetourReel = $dateHreRetourReel;

        return $this;
    }

    public function getLeVehicule(): ?Vehicule
    {
        return $this->leVehicule;
    }

    public function setLeVehicule(?Vehicule $leVehicule): self
    {
        $this->leVehicule = $leVehicule;

        return $this;
    }

    public function getLeClient(): ?client
    {
        return $this->leClient;
    }

    public function setLeClient(?client $leClient): self
    {
        $this->leClient = $leClient;

        return $this;
    }
}
