<?php

namespace App\Entity;

use App\Repository\CategoriesBlogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesBlogRepository::class)]
class CategoriesBlog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameCategory = null;

    #[ORM\OneToMany(mappedBy: 'categoriesBlog', targetEntity: ArticleBlog::class, orphanRemoval: true)]
    private Collection $articleBlog;

    public function __construct()
    {
        $this->articleBlog = new ArrayCollection();
    }

    

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategory(): ?string
    {
        return $this->nameCategory;
    }

    public function setNameCategory(string $nameCategory): static
    {
        $this->nameCategory = $nameCategory;

        return $this;
    }

    /**
     * @return Collection<int, ArticleBlog>
     */
    public function getArticleBlog(): Collection
    {
        return $this->articleBlog;
    }

    public function addArticleBlog(ArticleBlog $articleBlog): static
    {
        if (!$this->articleBlog->contains($articleBlog)) {
            $this->articleBlog->add($articleBlog);
            $articleBlog->setCategoriesBlog($this);
        }

        return $this;
    }

    public function removeArticleBlog(ArticleBlog $articleBlog): static
    {
        if ($this->articleBlog->removeElement($articleBlog)) {
            // set the owning side to null (unless already changed)
            if ($articleBlog->getCategoriesBlog() === $this) {
                $articleBlog->setCategoriesBlog(null);
            }
        }

        return $this;
    }

    
}
