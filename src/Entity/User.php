<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
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
     * @Groups("public")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(message="Veuillez remplir ce champs.")
     * @Assert\Regex(
     *      pattern="#^[\w.-]{3,20}$#", 
     *      message="Votre nom d'utilisateur doit comporter entre 3 et 20 caractères (a à z, A à Z, 0 à 9 et .,-,_).")
     * @Groups("public")
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
     * @ORM\Column(type="string", nullable=true)
     */
    private $confirmationToken;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $enabled;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role", mappedBy="role", cascade={"persist", "remove"})
     */
    private $userRoles;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $resetPassword;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Candidatures", mappedBy="candidat", cascade={"persist", "remove"})
     */
    private $candidatures;

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function initializeSlug()
    {
        $slugify = new Slugify;
        $this->slug = $slugify->slugify($this->prenom .' '. $this->nom);
    }

    /**
     * @ORM\PrePersist
     */
    public function initializeDate()
    {
        if(null === $this->lastLogin) 
        {
            $this->lastLogin = new \DateTime;
        }
        if(null === $this->registrationDate) 
        {
            $this->registrationDate = new \DateTime;
        }
    }

    public function __construct()
    {
        $this->userRoles = new ArrayCollection();
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
        $roles = $this->userRoles->map(function($role) 
        {
            return $role->getTitle();
        })->toArray();

        $roles[] = 'ROLE_USER';

        return $roles;
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

    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    public function setConfirmationToken(?string $confirmationToken): self
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(?bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Role[]
     */
    public function getUserRoles(): Collection
    {
        return $this->userRoles;
    }

    public function addUserRole(Role $userRole): self
    {
        if (!$this->userRoles->contains($userRole)) {
            $this->userRoles[] = $userRole;
            $userRole->addRole($this);
        }

        return $this;
    }

    public function removeUserRole(Role $userRole): self
    {
        if ($this->userRoles->contains($userRole)) {
            $this->userRoles->removeElement($userRole);
            $userRole->removeRole($this);
        }

        return $this;
    }

    public function getResetPassword(): ?string
    {
        return $this->resetPassword;
    }

    public function setResetPassword(?string $resetPassword): self
    {
        $this->resetPassword = $resetPassword;

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
        $newCandidat = null === $candidatures ? null : $this;
        if ($candidatures->getCandidat() !== $newCandidat) {
            $candidatures->setCandidat($newCandidat);
        }

        return $this;
    }
    

}
