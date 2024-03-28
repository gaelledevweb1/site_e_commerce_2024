<?php

namespace App\Entity;

use App\Repository\ArticleBlogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleBlogRepository::class)]
class ArticleBlog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contain = null;

    #[ORM\Column(length: 255)]
    private ?string $author = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\ManyToOne(inversedBy: 'article')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'articleBlog')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategoriesBlog $categoriesBlog = null;

    #[ORM\OneToMany(mappedBy: 'articleBlog', targetEntity: CommentsBlog::class)]
    private Collection $commentsBlog;

    public function __construct()
    {
        $this->commentsBlog = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;

        return $this;
    }

    public function getContain(): ?string
    {
        return $this->contain;
    }

    public function setContain(string $contain): static
    {
        $this->contain = $contain;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCategoriesBlog(): ?CategoriesBlog
    {
        return $this->categoriesBlog;
    }

    public function setCategoriesBlog(?CategoriesBlog $categoriesBlog): static
    {
        $this->categoriesBlog = $categoriesBlog;

        return $this;
    }

    /**
     * @return Collection<int, CommentsBlog>
     */
    public function getCommentsBlog(): Collection
    {
        return $this->commentsBlog;
    }

    public function addCommentsBlog(CommentsBlog $commentsBlog): static
    {
        if (!$this->commentsBlog->contains($commentsBlog)) {
            $this->commentsBlog->add($commentsBlog);
            $commentsBlog->setArticleBlog($this);
        }

        return $this;
    }

    public function removeCommentsBlog(CommentsBlog $commentsBlog): static
    {
        if ($this->commentsBlog->removeElement($commentsBlog)) {
            // set the owning side to null (unless already changed)
            if ($commentsBlog->getArticleBlog() === $this) {
                $commentsBlog->setArticleBlog(null);
            }
        }

        return $this;
    }
}
