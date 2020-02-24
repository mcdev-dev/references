<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InteretHabitatParticipatifRepository")
 */
class InteretHabitatParticipatif
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $motivations;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $contributionProjet;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $vieVoisinage;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $connaisanceProjet;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Candidatures", mappedBy="interetHabitatParticipatif", cascade={"persist", "remove"})
     */
    private $candidatures;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotivations(): ?string
    {
        return $this->motivations;
    }

    public function setMotivations(string $motivations): self
    {
        $this->motivations = $motivations;

        return $this;
    }

    public function getContributionProjet(): ?string
    {
        return $this->contributionProjet;
    }

    public function setContributionProjet(string $contributionProjet): self
    {
        $this->contributionProjet = $contributionProjet;

        return $this;
    }

    public function getVieVoisinage(): ?string
    {
        return $this->vieVoisinage;
    }

    public function setVieVoisinage(string $vieVoisinage): self
    {
        $this->vieVoisinage = $vieVoisinage;

        return $this;
    }

    public function getConnaisanceProjet(): ?string
    {
        return $this->connaisanceProjet;
    }

    public function setConnaisanceProjet(string $connaisanceProjet): self
    {
        $this->connaisanceProjet = $connaisanceProjet;

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
        $newInteretHabitatParticipatif = null === $candidatures ? null : $this;
        if ($candidatures->getInteretHabitatParticipatif() !== $newInteretHabitatParticipatif) {
            $candidatures->setInteretHabitatParticipatif($newInteretHabitatParticipatif);
        }

        return $this;
    }
}
