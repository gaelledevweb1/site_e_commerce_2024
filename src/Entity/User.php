<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

     #[ORM\Column(length: 255)]
     private ?string $firstName = null;

     #[ORM\Column(length: 255)]
     private ?string $lastName = null;

     #[ORM\Column(length: 255)]
     private ?string $address = null;

     #[ORM\Column(length: 255)]
     private ?string $city = null;

     #[ORM\Column]
     private ?int $zip = null;

     #[ORM\Column(length: 255)]
     private ?string $country = null;

     #[ORM\Column]
     private ?string $phone = null;

     #[ORM\Column(type: Types::DATE_MUTABLE)]
     private ?\DateTimeInterface $birthday = null;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private ?string $email;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    //  #[ORM\Column(length: 255)]
    //  private ?string $confirm_password = null;

    #[ORM\OneToOne(inversedBy: 'user', targetEntity: Cart::class,cascade: ['persist', 'remove'])]
    private ?Cart $cart = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Paiement $paiement = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Order::class)]
    private Collection $orders;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ArticleBlog::class, orphanRemoval: true)]
    private Collection $article;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: CommentsBlog::class)]
    private Collection $commentsBlog;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->article = new ArrayCollection();
        $this->commentsBlog = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

     public function getFirstName(): ?string
     {
         return $this->firstName;
     }

     public function setFirstName(string $firstName): static
     {
         $this->firstName = $firstName;

         return $this;
     }

     public function getLastName(): ?string
     {
         return $this->lastName;
     }

     public function setLastName(string $lastName): static
     {
         $this->lastName = $lastName;

         return $this;
     }

     public function getAddress(): ?string
     {
         return $this->address;
     }

     public function setAddress(string $address): static
     {
         $this->address = $address;

         return $this;
     }

     public function getCity(): ?string
     {
         return $this->city;
     }

     public function setCity(string $city): static
     {
         $this->city = $city;

         return $this;
     }

     public function getZip(): ?int
     {
         return $this->zip;
     }

     public function setZip(int $zip): static
     {
         $this->zip = $zip;

         return $this;
     }

     public function getCountry(): ?string
     {
         return $this->country;
     }

     public function setCountry(string $country): static
     {
         $this->country = $country;

         return $this;
     }

     public function getPhone(): ?string
     {
         return $this->phone;
     }

     public function setPhone(string $phone): static
     {
         $this->phone = $phone;

         return $this;
     }

     public function getBirthday(): ?\DateTimeInterface
     {
         return $this->birthday;
     }

     public function setBirthday(\DateTimeInterface $birthday): static
     {
         $this->birthday = $birthday;

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

    /**
     * The public representation of the user (e.g. a username, an email address, etc.)
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }


    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): static
    {
        $this->cart = $cart;

        return $this;
    }

    public function getPaiement(): ?Paiement
    {
        return $this->paiement;
    }

    public function setPaiement(Paiement $paiement): static
    {
        $this->paiement = $paiement;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setUser($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getUser() === $this) {
                $order->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ArticleBlog>
     */
    public function getArticle(): Collection
    {
        return $this->article;
    }

    public function addArticle(ArticleBlog $article): static
    {
        if (!$this->article->contains($article)) {
            $this->article->add($article);
            $article->setUser($this);
        }

        return $this;
    }

    public function removeArticle(ArticleBlog $article): static
    {
        if ($this->article->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getUser() === $this) {
                $article->setUser(null);
            }
        }

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
            $commentsBlog->setUser($this);
        }

        return $this;
    }

    public function removeCommentsBlog(CommentsBlog $commentsBlog): static
    {
        if ($this->commentsBlog->removeElement($commentsBlog)) {
            // set the owning side to null (unless already changed)
            if ($commentsBlog->getUser() === $this) {
                $commentsBlog->setUser(null);
            }
        }

        return $this;
    }
    // Vous devez également implémenter les méthodes requises par UserInterface ici.
    // Par exemple :
    public function getUsername()
    {
        // Retournez le nom d'utilisateur ici.
    }

     /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Returning a salt is only needed if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }


     /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    
}

