<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $file_name;

    #[ORM\Column(length: 255)]
    private string $alternative_text;

    #[ORM\Column(length: 255)]
    private string $title;

    #[ORM\Column(length: 255)]
    private string $caption;

    #[ORM\Column(length: 255)]
    private string $description;

    #[ORM\OneToMany(targetEntity: Guide::class, mappedBy: 'image')]
    private $guide;

    public function __construct()
    {
        $this->guide = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->file_name;
    }

    public function setFileName(string $file_name): self
    {
        $this->file_name = $file_name;

        return $this;
    }

    public function getAlternativeText(): ?string
    {
        return $this->alternative_text;
    }

    public function setAlternativeText(string $alternative_text): self
    {
        $this->alternative_text = $alternative_text;

        return $this;
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

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): self
    {
        $this->caption = $caption;

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
     * @return Collection|Article[]
     */
    public function getArticle(): Collection
    {
        return $this->guide;
    }

    public function addArticle(Guide $guide): self
    {
        if (!$this->guide->contains($guide)) {
            $this->guide[] = $guide;
            $guide->setImage($this);
        }

        return $this;
    }

    public function removeArticle(Guide $guide): self
    {
        if ($this->guide->removeElement($guide)) {
            // set the owning side to null (unless already changed)
            if ($guide->getImage() === $this) {
                $guide->setImage(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->file_name;
    }
}