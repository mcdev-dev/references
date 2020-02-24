<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TemporaryCandidaturesRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class TemporaryCandidatures
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $valider;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $statut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $sendAt;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\LogementActuel", cascade={"persist", "remove"})
     */
    private $logementActuel;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Menage", cascade={"persist", "remove"})
     */
    private $menage;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\SituationProFinanciere", cascade={"persist", "remove"})
     */
    private $situationProFinanciere;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\InteretHabitatParticipatif", cascade={"persist", "remove"})
     */
    private $interetHabitatParticipatif;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     */
    private $candidat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $promoteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $promoteurLogo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Categorie", cascade={"persist", "remove"})
     */
    private $categorie;


    /**
     * @ORM\PrePersist
     * @return void
     */
    public function prePersist() 
    {
        if($this->sendAt == null) 
        {
            $this->sendAt = new \Datetime;
        }
        if($this->createdAt == null) 
        {
            $this->createdAt = new \Datetime;
        }
    }

    /**
     * @ORM\PreUpdate
     * @return void
     */
    public function preUpdate() 
    {
        $this->sendAt = new \Datetime;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getValider(): ?bool
    {
        return $this->valider;
    }

    public function setValider(?bool $valider): self
    {
        $this->valider = $valider;

        return $this;
    }

    public function getStatut(): ?int
    {
        return $this->statut;
    }

    public function setStatut(?int $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSendAt(): ?\DateTimeInterface
    {
        return $this->sendAt;
    }

    public function setSendAt(\DateTimeInterface $sendAt): self
    {
        $this->sendAt = $sendAt;

        return $this;
    }

    public function getLogementActuel(): ?LogementActuel
    {
        return $this->logementActuel;
    }

    public function setLogementActuel(?LogementActuel $logementActuel): self
    {
        $this->logementActuel = $logementActuel;

        return $this;
    }

    public function getMenage(): ?Menage
    {
        return $this->menage;
    }

    public function setMenage(?Menage $menage): self
    {
        $this->menage = $menage;

        return $this;
    }

    public function getSituationProFinanciere(): ?SituationProFinanciere
    {
        return $this->situationProFinanciere;
    }

    public function setSituationProFinanciere(?SituationProFinanciere $situationProFinanciere): self
    {
        $this->situationProFinanciere = $situationProFinanciere;

        return $this;
    }

    public function getInteretHabitatParticipatif(): ?InteretHabitatParticipatif
    {
        return $this->interetHabitatParticipatif;
    }

    public function setInteretHabitatParticipatif(?InteretHabitatParticipatif $interetHabitatParticipatif): self
    {
        $this->interetHabitatParticipatif = $interetHabitatParticipatif;

        return $this;
    }

    public function getCandidat(): ?User
    {
        return $this->candidat;
    }

    public function setCandidat(?User $candidat): self
    {
        $this->candidat = $candidat;

        return $this;
    }

    public function getPromoteur(): ?string
    {
        return $this->promoteur;
    }

    public function setPromoteur(string $promoteur): self
    {
        $this->promoteur = $promoteur;

        return $this;
    }

    public function getPromoteurLogo(): ?string
    {
        return $this->promoteurLogo;
    }

    public function setPromoteurLogo(string $promoteurLogo): self
    {
        $this->promoteurLogo = $promoteurLogo;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
