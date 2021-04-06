<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationAvecChauffeurRepository")
 */
class LocationAvecChauffeur extends Location
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

   
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FormuleAvecChauffeur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $laFormuleAC;

    

    public function getLaFormuleAC(): ?FormuleAvecChauffeur
    {
        return $this->laFormuleAC;
    }

    public function setLaFormuleAC(?FormuleAvecChauffeur $laFormuleAC): self
    {
        $this->laFormuleAC = $laFormuleAC;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
