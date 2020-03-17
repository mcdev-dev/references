<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\RefLogementsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class RefLogements
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
     * @ORM\OneToMany(targetEntity="App\Entity\MediaReference", mappedBy="RefLogements", cascade={"persist", "remove"})
     */
    private $images;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="reference", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContenuReference", mappedBy="RefLogements", cascade={"persist", "remove"})
     */
    private $contenuReference;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->contenuReference = new ArrayCollection();
    }

     /**
     * @ORM\PrePersist
     */
    public function prePersist() 
    {
        if($this->createdAt == null) 
        {
            $this->createdAt = new \Datetime;
        }
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

    /**
     * @return Collection|MediaReference[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImages(MediaReference $image): self
    {
        if (!$this->images->contains($image)){
            $this->images[] = $image;
            $image->setRefLogements($this);
        }
        return $this;
    }

    public function removeImage(MediaReference $image): self
    {
        if ($this->images->contains($image)){
            $this->images->removeElement($image);
            if ($image->getRefLogements() === $this){
                $image->setRefLogements(null);
            }
        }
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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;
        return $this;
    }


    /**
     * @return Collection|ContenuReference[]
     */
    public function getContenuReference(): Collection
    {
        return $this->contenuReference;
    }

    public function addContenuReference(ContenuReference $contenuReference): self
    {
        if (!$this->contenuReference->contains($contenuReference)) {
            $this->contenuReference[] = $contenuReference;
            $contenuReference->setReference($this);
        }
        return $this;
    }

    public function removeContenuReference(ContenuReference $contenuReference): self
    {
        if ($this->contenuReference->contains($contenuReference)) {
            $this->contenuReference->removeElement($contenuReference);
            // set the owning side to null (unless already changed)
            if ($contenuReference->getReference() === $this) {
                $contenuReference->setReference(null);
            }
        }
        return $this;
    }

}
