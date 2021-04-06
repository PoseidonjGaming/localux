<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TarificationRepository")
 * @ORM\Table(name="tarification",uniqueConstraints={@ORM\UniqueConstraint(name="modele_tarif_unique", columns={"le_modele_id", "la_formule_sc_id"})})
 */
class Tarification
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $tarif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Modele")
     * @ORM\JoinColumn(nullable=false)
     */
    private $leModele;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FormuleSansChauffeur", inversedBy="lesTarifications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $laFormuleSC;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(float $tarif): self
    {
        $this->tarif = $tarif;

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
