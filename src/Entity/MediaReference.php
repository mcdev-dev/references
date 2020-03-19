<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity(repositoryClass="App\Repository\MediaReferenceRepository")
 * @Vich\Uploadable
 */
class MediaReference
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Vich\UploadableField(mapping="lescityzens_photos", fileNameProperty="imageName")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updateAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RefLogements", inversedBy="images")
     */
    private $refLogements;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
        if(null !== $imageFile) {
            $this->updateAt = new \DateTimeImmutable();
        }
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;
        return $this;
    }

    public function getRefLogements(): ?RefLogements
    {
        return $this->refLogements;
    }

    public function setRefLogements(?RefLogements $refLogements): self
    {
        $this->refLogements = $refLogements;
        return $this;
    }
}
