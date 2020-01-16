<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
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
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="categorie")
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleActu", mappedBy="categorie")
     */
    private $articleActus;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RefLogements", mappedBy="categorie", orphanRemoval=true)
     */
    private $reference;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->articleActus = new ArrayCollection();
        $this->reference = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setCategorie($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getCategorie() === $this) {
                $article->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * Generates the magic method
     * 
     */
    public function __toString(){
        // to show the name of the Category in the select
        return $this->title;
        // to show the id of the Category in the select
        // return $this->id;
    }

    /**
     * @return Collection|ArticleActu[]
     */
    public function getArticleActus(): Collection
    {
        return $this->articleActus;
    }

    public function addArticleActus(ArticleActu $articleActus): self
    {
        if (!$this->articleActus->contains($articleActus)) {
            $this->articleActus[] = $articleActus;
            $articleActus->setCategorie($this);
        }

        return $this;
    }

    public function removeArticleActus(ArticleActu $articleActus): self
    {
        if ($this->articleActus->contains($articleActus)) {
            $this->articleActus->removeElement($articleActus);
            // set the owning side to null (unless already changed)
            if ($articleActus->getCategorie() === $this) {
                $articleActus->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RefLogements[]
     */
    public function getReference(): Collection
    {
        return $this->reference;
    }

    public function addReference(RefLogements $reference): self
    {
        if (!$this->reference->contains($reference)) {
            $this->reference[] = $reference;
            $reference->setCategorie($this);
        }

        return $this;
    }

    public function removeReference(RefLogements $reference): self
    {
        if ($this->reference->contains($reference)) {
            $this->reference->removeElement($reference);
            // set the owning side to null (unless already changed)
            if ($reference->getCategorie() === $this) {
                $reference->setCategorie(null);
            }
        }

        return $this;
    }

}
