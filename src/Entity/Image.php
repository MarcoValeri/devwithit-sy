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

    #[ORM\OneToMany(targetEntity: Node::class, mappedBy: 'image')]
    private $node;

    #[ORM\OneToMany(targetEntity: React::class, mappedBy: 'image')]
    private $react;

    public function __construct()
    {
        $this->guide = new ArrayCollection();
        $this->node = new ArrayCollection();
        $this->react = new ArrayCollection();
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
     * @return Collection|Guide[]
     */
    public function getGuide(): Collection
    {
        return $this->guide;
    }

    public function addGuide(Guide $guide): self
    {
        if (!$this->guide->contains($guide)) {
            $this->guide[] = $guide;
            $guide->setImage($this);
        }

        return $this;
    }

    public function removeGuide(Guide $guide): self
    {
        if ($this->guide->removeElement($guide)) {
            // set the owning side to null (unless already changed)
            if ($guide->getImage() === $this) {
                $guide->setImage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Node[]
     */
    public function getNode(): Collection
    {
        return $this->node;
    }

    public function addNode(Node $node): self
    {
        if (!$this->node->contains($node)) {
            $this->node[] = $node;
            $node->setImage($this);
        }

        return $this;
    }

    public function removeNode(Node $node): self
    {
        if ($this->node->removeElement($node)) {
            // set the owning side to null (unless already changed)
            if ($node->getImage() === $this) {
                $node->setImage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|React[]
     */
    public function getReact(): Collection
    {
        return $this->react;
    }

    public function addReact(React $react): self
    {
        if (!$this->react->contains($react)) {
            $this->react[] = $react;
            $react->setImage($this);
        }

        return $this;
    }

    public function removeReact(React $react): self
    {
        if ($this->react->removeElement($react)) {
            // set the owning side to null (unless already changed)
            if ($react->getImage() === $this) {
                $react->setImage(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->file_name;
    }
}