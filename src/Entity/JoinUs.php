<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JoinUsRepository")
 * @Vich\Uploadable
 */
class JoinUs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Veuillez saisir votre nom")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Veuillez saisir votre prénom")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Veuillez entrer votre email")
     * @Assert\Email(checkMX="true", message="Veuillez entrer un email valide.")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez entrer un sujet")
     */
    private $subject;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Veuillez saisir un petit message")
     */
    private $message;

    /**
     * 
     * @Vich\UploadableField(mapping="lescityzens_photos", fileNameProperty="cv")
     * 
     * @var File
     */
    private $cvFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cv;

    /**
     * 
     * @Vich\UploadableField(mapping="lescityzens_photos", fileNameProperty="lettreMotivation")
     * 
     * @var File
     */
    private $lettreMotivationFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lettreMotivation;

    /**
     * 
     * @Vich\UploadableField(mapping="lescityzens_photos", fileNameProperty="book")
     * 
     * @var File
     */
    private $bookFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $book;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $cvFile
     */
    public function setCvFile(?File $cvFile = null): void
    {
        $this->cvFile = $cvFile;

        if (null !== $cvFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getCvFile(): ?File
    {
        return $this->cvFile;
    }

    public function setCv(?string $cv): void
    {
        $this->cv = $cv;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $lettreMotivationFile
     */
    public function setLettreMotivationFile(?File $lettreMotivationFile = null): void
    {
        $this->lettreMotivationFile = $lettreMotivationFile;

        if (null !== $lettreMotivationFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getLettreMotivationFile(): ?File
    {
        return $this->lettreMotivationFile;
    }

    public function setLettreMotivation(?string $lettreMotivation): void
    {
        $this->lettreMotivation = $lettreMotivation;
    }

    public function getLettreMotivation(): ?string
    {
        return $this->lettreMotivation;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $bookFile
     */
    public function setBookFile(?File $bookFile = null): void
    {
        $this->bookFile = $bookFile;

        if (null !== $bookFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getBookFile(): ?File
    {
        return $this->bookFile;
    }

    public function setBook(?string $book): void
    {
        $this->book = $book;
    }

    public function getBook(): ?string
    {
        return $this->book;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


    
}
