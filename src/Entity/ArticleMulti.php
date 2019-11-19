<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleMultiRepository")
 */
class ArticleMulti
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $transport;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $santeServicesSociaux;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $servicesAdmin;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $education;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $sports;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Media", mappedBy="articleMulti")
     */
    private $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTransport(): ?string
    {
        return $this->transport;
    }

    public function setTransport(?string $transport): self
    {
        $this->transport = $transport;

        return $this;
    }

    public function getSanteServicesSociaux(): ?string
    {
        return $this->santeServicesSociaux;
    }

    public function setSanteServicesSociaux(?string $santeServicesSociaux): self
    {
        $this->santeServicesSociaux = $santeServicesSociaux;

        return $this;
    }

    public function getServicesAdmin(): ?string
    {
        return $this->servicesAdmin;
    }

    public function setServicesAdmin(?string $servicesAdmin): self
    {
        $this->servicesAdmin = $servicesAdmin;

        return $this;
    }

    public function getEducation(): ?string
    {
        return $this->education;
    }

    public function setEducation(?string $education): self
    {
        $this->education = $education;

        return $this;
    }

    public function getSports(): ?string
    {
        return $this->sports;
    }

    public function setSports(?string $sports): self
    {
        $this->sports = $sports;

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Media $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setArticleMulti($this);
        }

        return $this;
    }

    public function removeImage(Media $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getArticleMulti() === $this) {
                $image->setArticleMulti(null);
            }
        }

        return $this;
    }
}
