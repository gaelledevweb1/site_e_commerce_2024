<?php

namespace App\Entity;


use App\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $articleQuantity = null;

    #[ORM\OneToOne(mappedBy: 'cart',targetEntity: User::class ,cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticleQuantity(): ?int
    {
        return $this->articleQuantity;
    }

    public function setArticleQuantity(int $articleQuantity): static
    {
        $this->articleQuantity = $articleQuantity;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setCart(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getCart() !== $this) {
            $user->setCart($this);
        }

        $this->user = $user;

        return $this;
    }
}
