<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @Assert\NotBlank(message="Veuillez remplir ce champs.")
     */
    private $password;

    /**
     * @Assert\NotBlank(message="Veuillez remplir ce champs.")
     * @Assert\EqualTo(
     *      propertyPath="password",
     *      message="Erreur sur le mot de passe")
     */
    public $confirmPassword;

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
     * @Assert\NotBlank(message="Veuillez remplir ce champs.")
     * @Assert\Regex(
     *      pattern="~^[a-zA-ZÀ-ÖØ-öø-ÿœŒ ]+$~u", 
     *      message="Votre nom doit comporter entre 3 et 20 caractères.")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Veuillez remplir ce champs.")
     * @Assert\Email(checkMX="true", message="Veuillez entrer un email valide.")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $role = 'ROLE_USER'; // !IMPORTANT

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $abonneNewsletter;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserCoordonnees", mappedBy="users")
     */
    private $userCoordonnees;

    public function __construct()
    {
        $this->userCoordonnees = new ArrayCollection();
    }

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

    public function getAbonneNewsletter(): ?string
    {
        return $this->abonneNewsletter;
    }

    public function setAbonneNewsletter(?string $abonneNewsletter): self
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

    /**
     * @return Collection|UserCoordonnees[]
     */
    public function getUserCoordonnees(): Collection
    {
        return $this->userCoordonnees;
    }

    public function addUserCoordonnee(UserCoordonnees $userCoordonnee): self
    {
        if (!$this->userCoordonnees->contains($userCoordonnee)) {
            $this->userCoordonnees[] = $userCoordonnee;
            $userCoordonnee->setUsers($this);
        }

        return $this;
    }

    public function removeUserCoordonnee(UserCoordonnees $userCoordonnee): self
    {
        if ($this->userCoordonnees->contains($userCoordonnee)) {
            $this->userCoordonnees->removeElement($userCoordonnee);
            // set the owning side to null (unless already changed)
            if ($userCoordonnee->getUsers() === $this) {
                $userCoordonnee->setUsers(null);
            }
        }

        return $this;
    }

    

}
