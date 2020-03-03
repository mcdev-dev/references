<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MenageRepository")
 */
class Menage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $personnesACharges1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $tailleFoyer;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $personnesACharges2;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $personnesACharges3;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $personnesACharges4;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Candidatures", mappedBy="menage", cascade={"persist", "remove"})
     */
    private $candidatures;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Acquereur", cascade={"persist", "remove"})
     * @Assert\Valid
     */
    private $acquereur;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Acquereur", cascade={"persist", "remove"})
     */
    private $coAcquereur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonnesACharges1(): ?string
    {
        return $this->personnesACharges1;
    }

    public function setPersonnesACharges1(?string $personnesACharges1): self
    {
        $this->personnesACharges1 = $personnesACharges1;

        return $this;
    }

    public function getTailleFoyer(): ?string
    {
        return $this->tailleFoyer;
    }

    public function setTailleFoyer(string $tailleFoyer): self
    {
        $this->tailleFoyer = $tailleFoyer;

        return $this;
    }

    public function getPersonnesACharges2(): ?string
    {
        return $this->personnesACharges2;
    }

    public function setPersonnesACharges2(?string $personnesACharges2): self
    {
        $this->personnesACharges2 = $personnesACharges2;

        return $this;
    }

    public function getPersonnesACharges3(): ?string
    {
        return $this->personnesACharges3;
    }

    public function setPersonnesACharges3(?string $personnesACharges3): self
    {
        $this->personnesACharges3 = $personnesACharges3;

        return $this;
    }

    public function getPersonnesACharges4(): ?string
    {
        return $this->personnesACharges4;
    }

    public function setPersonnesACharges4(?string $personnesACharges4): self
    {
        $this->personnesACharges4 = $personnesACharges4;

        return $this;
    }

    public function getCandidatures(): ?Candidatures
    {
        return $this->candidatures;
    }

    public function setCandidatures(?Candidatures $candidatures): self
    {
        $this->candidatures = $candidatures;

        // set (or unset) the owning side of the relation if necessary
        $newMenage = null === $candidatures ? null : $this;
        if ($candidatures->getMenage() !== $newMenage) {
            $candidatures->setMenage($newMenage);
        }

        return $this;
    }

    public function getAcquereur(): ?Acquereur
    {
        return $this->acquereur;
    }

    public function setAcquereur(?Acquereur $acquereur): self
    {
        $this->acquereur = $acquereur;

        return $this;
    }

    public function getCoAcquereur(): ?Acquereur
    {
        return $this->coAcquereur;
    }

    public function setCoAcquereur(?Acquereur $coAcquereur): self
    {
        $this->coAcquereur = $coAcquereur;

        return $this;
    }
}
