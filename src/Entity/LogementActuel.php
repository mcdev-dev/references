<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LogementActuelRepository")
 */
class LogementActuel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array", nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $logementRecherche = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $surfaceMinimale;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $surfaceMaximale;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $logementActuel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statutOccupation;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $montantLoyer;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Candidatures", mappedBy="logementActuel", cascade={"persist", "remove"})
     */
    private $candidatures;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogementActuel(): ?string
    {
        return $this->logementActuel;
    }

    public function setLogementActuel(string $logementActuel): self
    {
        $this->logementActuel = $logementActuel;

        return $this;
    }

    public function getSurfaceMinimale(): ?int
    {
        return $this->surfaceMinimale;
    }

    public function setSurfaceMinimale(int $surfaceMinimale): self
    {
        $this->surfaceMinimale = $surfaceMinimale;

        return $this;
    }

    public function getSurfaceMaximale(): ?int
    {
        return $this->surfaceMaximale;
    }

    public function setSurfaceMaximale(int $surfaceMaximale): self
    {
        $this->surfaceMaximale = $surfaceMaximale;

        return $this;
    }

    public function getLogementRecherche(): ?array
    {
        return $this->logementRecherche;
    }

    public function setLogementRecherche(array $logementRecherche): self
    {
        $this->logementRecherche = $logementRecherche;

        return $this;
    }

    public function getStatutOccupation(): ?string
    {
        return $this->statutOccupation;
    }

    public function setStatutOccupation(?string $statutOccupation): self
    {
        $this->statutOccupation = $statutOccupation;

        return $this;
    }

    public function getMontantLoyer(): ?int
    {
        return $this->montantLoyer;
    }

    public function setMontantLoyer(?int $montantLoyer): self
    {
        $this->montantLoyer = $montantLoyer;

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
        $newLogementActuel = null === $candidatures ? null : $this;
        if ($candidatures->getLogementActuel() !== $newLogementActuel) {
            $candidatures->setLogementActuel($newLogementActuel);
        }

        return $this;
    }


}
