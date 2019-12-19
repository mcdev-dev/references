<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *      fields={"username"},
 *      message="Désolé, ce nom d'utilisateur est déjà utilisé.")
 * @UniqueEntity(
 *      fields={"email"},
 *      message="Désolé, cet email est déjà utilisé.")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(message="Veuillez remplir ce champs.")
     * @Assert\Regex(
     *      pattern="#^[\w.-]{3,20}$#", 
     *      message="Votre nom d'utilisateur doit comporter entre 3 et 20 caractères (a à z, A à Z, 0 à 9 et .,-,_).")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez saisir votre mot de passe.")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Veuillez remplir ce champs.")
     * @Assert\Regex(
     *      pattern="~^[a-zA-ZÀ-ÖØ-öø-ÿœŒ ]+$~u", 
     *      message="Votre nom doit comporter entre 3 et 20 caractères.")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Veuillez saisir votre prénom.")
     * @Assert\Regex(
     *      pattern="~^[a-zA-ZÀ-ÖØ-öø-ÿœŒ ]+$~u", 
     *      message="Votre nom doit comporter entre 3 et 20 caractères.")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Veuillez insérer votre email.")
     * @Assert\Email(checkMX="true", message="Veuillez entrer un email valide.")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $role = 'ROLE_USER'; // !IMPORTANT

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $abonneNewsletter = false;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(message="Veuillez préciser votre civilité.")
     */
    private $civilite;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastLogin;

    /**
     * @ORM\Column(type="datetime")
     */
    private $registrationDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserCoordonnees", inversedBy="users", cascade={"persist", "remove"})
     */
    private $userCoordonnees;

    /**
     * Not ORM property
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $confirmationToken;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $enabled;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getAbonneNewsletter(): ?bool
    {
        return $this->abonneNewsletter;
    }

    public function setAbonneNewsletter(?bool $abonneNewsletter): self
    {
        $this->abonneNewsletter = $abonneNewsletter;

        return $this;
    }

    public function getRoles(): array
    {
        // guarantee every user at least has ROLE_USER
        $roles[] = $this->role;

        return array_unique($roles);
    }
    public function getSalt(){}
    public function eraseCredentials(){}

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    public function setLastLogin(\DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    public function getRegistrationDate(): ?\DateTimeInterface
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(\DateTimeInterface $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    public function getUserCoordonnees(): ?UserCoordonnees
    {
        return $this->userCoordonnees;
    }

    public function setUserCoordonnees(?UserCoordonnees $userCoordonnees): self
    {
        $this->userCoordonnees = $userCoordonnees;

        return $this;
    }

    public function getPlainPassword() 
    {
        return $this->plainPassword;
    }
    public function setPlainPassword($plainPassword) 
    {
        return $this->plainPassword = $plainPassword;

    }

    public function getConfirmationToken(): ?bool
    {
        return $this->confirmationToken;
    }

    public function setConfirmationToken(bool $confirmationToken): self
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    

}
