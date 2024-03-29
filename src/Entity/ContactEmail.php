<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactEmailRepository")
 */
class ContactEmail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez remplir ce champs")
     * @Assert\Regex(
     *      pattern="#^[\w.-]{5,50}$#",
     *      message="Le sujet doit comporter entre 5 et 50 caractères (a à z, A à Z, 0 à 9 et .,-,_).")
     */
    private $Subject;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank(message="Veuillez remplir ce champs")
     * @Assert\Regex(
     *      pattern="~^[a-zA-ZÀ-ÖØ-öø-ÿœŒ ]+$~u", 
     *      message="Veuillez entrer un prénom valide.")
     */
    private $Firstname;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank(message="Veuillez remplir ce champs")
     * @Assert\Regex(
     *      pattern="~^[a-zA-ZÀ-ÖØ-öø-ÿœŒ ]+$~u", 
     *      message="Veuillez entrer un nom valide.")
     */
    private $Lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez remplir ce champs")
     * @Assert\Email(checkMX="true", message="Veuillez entrer un email valide.")
     */
    private $FromEmail;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Company;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * 
     */
    private $PhoneNumber;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Veuillez remplir ce champs")
     */
    private $Content;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->Subject;
    }

    public function setSubject(string $Subject): self
    {
        $this->Subject = $Subject;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->Firstname;
    }

    public function setFirstname(string $Firstname): self
    {
        $this->Firstname = $Firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->Lastname;
    }

    public function setLastname(string $Lastname): self
    {
        $this->Lastname = $Lastname;

        return $this;
    }

    public function getFromEmail(): ?string
    {
        return $this->FromEmail;
    }

    public function setFromEmail(string $FromEmail): self
    {
        $this->FromEmail = $FromEmail;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->Company;
    }

    public function setCompany(?string $Company): self
    {
        $this->Company = $Company;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->PhoneNumber;
    }

    public function setPhoneNumber(?int $PhoneNumber): self
    {
        $this->PhoneNumber = $PhoneNumber;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

}
