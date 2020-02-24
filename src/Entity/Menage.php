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
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $civilite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $categorieSocioPro;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $phonePortable;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $phoneDomicile;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $phonePro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $coAcquereur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Champs requis")
     */
    private $situationFamiliale;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?string
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(string $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getCategorieSocioPro(): ?string
    {
        return $this->categorieSocioPro;
    }

    public function setCategorieSocioPro(string $categorieSocioPro): self
    {
        $this->categorieSocioPro = $categorieSocioPro;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(int $codePostal): self
    {
        $this->codePostal = $codePostal;

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

    public function getPhonePortable(): ?string
    {
        return $this->phonePortable;
    }

    public function setPhonePortable(string $phonePortable): self
    {
        $this->phonePortable = $phonePortable;

        return $this;
    }

    public function getPhoneDomicile(): ?string
    {
        return $this->phoneDomicile;
    }

    public function setPhoneDomicile(?string $phoneDomicile): self
    {
        $this->phoneDomicile = $phoneDomicile;

        return $this;
    }

    public function getPhonePro(): ?string
    {
        return $this->phonePro;
    }

    public function setPhonePro(?string $phonePro): self
    {
        $this->phonePro = $phonePro;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCoAcquereur(): ?string
    {
        return $this->coAcquereur;
    }

    public function setCoAcquereur(?string $coAcquereur): self
    {
        $this->coAcquereur = $coAcquereur;

        return $this;
    }

    public function getSituationFamiliale(): ?string
    {
        return $this->situationFamiliale;
    }

    public function setSituationFamiliale(string $situationFamiliale): self
    {
        $this->situationFamiliale = $situationFamiliale;

        return $this;
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
}
