<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationSansChauffeurRepository")
 */
class LocationSansChauffeur extends Location
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
    private $nbKmsDepart;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbKmRetour;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FormuleSansChauffeur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $laFormuleSC;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbKmsDepart(): ?int
    {
        return $this->nbKmsDepart;
    }

    public function setNbKmsDepart(int $nbKmsDepart): self
    {
        $this->nbKmsDepart = $nbKmsDepart;

        return $this;
    }

    public function getNbKmRetour(): ?int
    {
        return $this->nbKmRetour;
    }

    public function setNbKmRetour(?int $nbKmRetour): self
    {
        $this->nbKmRetour = $nbKmRetour;

        return $this;
    }

    public function getLaFormuleSC(): ?FormuleSansChauffeur
    {
        return $this->laFormuleSC;
    }

    public function setLaFormuleSC(?FormuleSansChauffeur $laFormuleSC): self
    {
        $this->laFormuleSC = $laFormuleSC;

        return $this;
    }
}
