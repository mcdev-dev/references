<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SituationProFinanciereRepository")
 */
class SituationProFinanciere
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $acquereurStatutEmploi;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $acquereurSalaireMensuelMoyen;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $acquereurRevenusImpos;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $coAcquereurStatutEmploi;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $coAcquereurSalaireMensuelMoyen;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coAcquereurRevenusImpos;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $sourceRevenus1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $sourceRevenus2;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $sourceRevenus3;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CreditsEnCours", cascade={"persist", "remove"})
     */
    private $creditEnCours1;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CreditsEnCours", cascade={"persist", "remove"})
     */
    private $creditEnCours2;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CreditsEnCours", cascade={"persist", "remove"})
     */
    private $creditEnCours3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $apportPersonnel;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Candidatures", mappedBy="situationProFinanciere", cascade={"persist", "remove"})
     */
    private $candidatures;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAcquereurStatutEmploi(): ?string
    {
        return $this->acquereurStatutEmploi;
    }

    public function setAcquereurStatutEmploi(string $acquereurStatutEmploi): self
    {
        $this->acquereurStatutEmploi = $acquereurStatutEmploi;

        return $this;
    }

    public function getAcquereurSalaireMensuelMoyen(): ?int
    {
        return $this->acquereurSalaireMensuelMoyen;
    }

    public function setAcquereurSalaireMensuelMoyen(int $acquereurSalaireMensuelMoyen): self
    {
        $this->acquereurSalaireMensuelMoyen = $acquereurSalaireMensuelMoyen;

        return $this;
    }

    public function getAcquereurRevenusImpos(): ?string
    {
        return $this->acquereurRevenusImpos;
    }

    public function setAcquereurRevenusImpos(string $acquereurRevenusImpos): self
    {
        $this->acquereurRevenusImpos = $acquereurRevenusImpos;

        return $this;
    }

    public function getCoAcquereurStatutEmploi(): ?string
    {
        return $this->coAcquereurStatutEmploi;
    }

    public function setCoAcquereurStatutEmploi(?string $coAcquereurStatutEmploi): self
    {
        $this->coAcquereurStatutEmploi = $coAcquereurStatutEmploi;

        return $this;
    }

    public function getSourceRevenus1(): ?string
    {
        return $this->sourceRevenus1;
    }

    public function setSourceRevenus1(?string $sourceRevenus1): self
    {
        $this->sourceRevenus1 = $sourceRevenus1;

        return $this;
    }

    public function getApportPersonnel(): ?string
    {
        return $this->apportPersonnel;
    }

    public function setApportPersonnel(string $apportPersonnel): self
    {
        $this->apportPersonnel = $apportPersonnel;

        return $this;
    }

    public function getSourceRevenus2(): ?string
    {
        return $this->sourceRevenus2;
    }

    public function setSourceRevenus2(?string $sourceRevenus2): self
    {
        $this->sourceRevenus2 = $sourceRevenus2;

        return $this;
    }

    public function getSourceRevenus3(): ?string
    {
        return $this->sourceRevenus3;
    }

    public function setSourceRevenus3(?string $sourceRevenus3): self
    {
        $this->sourceRevenus3 = $sourceRevenus3;

        return $this;
    }

    public function getCoAcquereurSalaireMensuelMoyen(): ?int
    {
        return $this->coAcquereurSalaireMensuelMoyen;
    }

    public function setCoAcquereurSalaireMensuelMoyen(int $coAcquereurSalaireMensuelMoyen): self
    {
        $this->coAcquereurSalaireMensuelMoyen = $coAcquereurSalaireMensuelMoyen;

        return $this;
    }

    public function getCoAcquereurRevenusImpos(): ?string
    {
        return $this->coAcquereurRevenusImpos;
    }

    public function setCoAcquereurRevenusImpos(string $coAcquereurRevenusImpos): self
    {
        $this->coAcquereurRevenusImpos = $coAcquereurRevenusImpos;

        return $this;
    }

    public function getCreditEnCours1(): ?CreditsEnCours
    {
        return $this->creditEnCours1;
    }

    public function setCreditEnCours1(?CreditsEnCours $creditEnCours1): self
    {
        $this->creditEnCours1 = $creditEnCours1;

        return $this;
    }

    public function getCreditEnCours2(): ?CreditsEnCours
    {
        return $this->creditEnCours2;
    }

    public function setCreditEnCours2(?CreditsEnCours $creditEnCours2): self
    {
        $this->creditEnCours2 = $creditEnCours2;

        return $this;
    }

    public function getCreditEnCours3(): ?CreditsEnCours
    {
        return $this->creditEnCours3;
    }

    public function setCreditEnCours3(?CreditsEnCours $creditEnCours3): self
    {
        $this->creditEnCours3 = $creditEnCours3;

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
        $newSituationProFinanciere = null === $candidatures ? null : $this;
        if ($candidatures->getSituationProFinanciere() !== $newSituationProFinanciere) {
            $candidatures->setSituationProFinanciere($newSituationProFinanciere);
        }

        return $this;
    }
}
