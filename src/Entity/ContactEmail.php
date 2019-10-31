<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $Subject;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $Firstname;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $Lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FromEmail;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $Company;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $PhoneNumber;

    /**
     * @ORM\Column(type="text")
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
