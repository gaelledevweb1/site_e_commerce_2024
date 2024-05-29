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
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: UserRepository::class)]
 #[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
 #[ORM\HasLifecycleCallbacks]
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

    //  #[ORM\Column(length: 255)]
    //  private ?string $address = null;

    //  #[ORM\Column(length: 255)]
    //  private ?string $city = null;

    //  #[ORM\Column]
    //  private ?int $zip = null;

    //  #[ORM\Column(length: 255)]
    //  private ?string $country = null;

     #[ORM\Column]
     private ?string $phone = null;

    //  #[ORM\Column(type: Types::DATE_MUTABLE)]
    //  private ?\DateTimeInterface $birthday = null;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private ?string $email;

    
 
    #[ORM\Column(length: 255)]
    private ?string $password = null;

    //  #[ORM\Column(length: 255)]
    //  private ?string $confirm_password = null;

    #[ORM\OneToOne(inversedBy: 'user', targetEntity: Cart::class,cascade: ['persist', 'remove'])]
    private ?Cart $cart = null;

    

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Order::class)]
    private Collection $orders;

   
    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Adress::class)]
    private Collection $adress;

    #[ORM\Column(type:"datetime_immutable")]
    private ?\DateTimeImmutable $CreatedAt = null;

    #[ORM\Column (type:"datetime_immutable")]
    private ?\DateTimeImmutable $UpdateAt = null;

    

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        
        
        $this->adress= new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    
    #[Assert\Sequentially([
        new Assert\NotBlank,
        new Assert\Type('string'),
        new Assert\Length(min: 2,max:20),
        
    ])]
    #[Assert\Regex(
        pattern: '/\d/',
        match: false,
        message: 'Your name cannot contain a number',
    )]
        
     public function getFirstName(): ?string
     {
         return $this->firstName;
     }

    
     public function setFirstName(string $firstName): static
     {
         $this->firstName = $firstName;

         return $this;
     }

     #[Assert\Sequentially([
        new Assert\NotBlank,
        new Assert\Type('string'),
        new Assert\Length(min: 2,max:20),
        
    ])]
    #[Assert\Regex(
        pattern: '/\d/',
        match: false,
        message: 'Your name cannot contain a number',
    )]
     public function getLastName(): ?string
     {
         return $this->lastName;
     }

     public function setLastName(string $lastName): static
     {
         $this->lastName = $lastName;

         return $this;
     }

    //  public function getAddress(): ?string
    //  {
    //      return $this->address;
    //  }

    //  public function setAddress(string $address): static
    //  {
    //      $this->address = $address;

    //      return $this;
    //  }

    //  public function getCity(): ?string
    //  {
    //      return $this->city;
    //  }

    //  public function setCity(string $city): static
    //  {
    //      $this->city = $city;

    //      return $this;
    //  }

    //  public function getZip(): ?int
    //  {
    //      return $this->zip;
    //  }

    //  public function setZip(int $zip): static
    //  {
    //      $this->zip = $zip;

    //      return $this;
    //  }

    //  public function getCountry(): ?string
    //  {
    //      return $this->country;
    //  }

    //  public function setCountry(string $country): static
    //  {
    //      $this->country = $country;

    //      return $this;
    //  }

    // #[Assert\Regex(
    //     pattern: '[+]?[(]?[0-9]{3}[)]?[-\s.]?[0-9]{3}[-\s.]?[0-9]{4,6}',
    //     match: true,
    //     message: 'Please enter a valid phone number'
    // )]
     public function getPhone(): ?string
     {
         return $this->phone;
     }

     public function setPhone(string $phone): static
     {
         $this->phone = $phone;

         return $this;
     }



     
    //  #[Assert\DateTime()]
    //  public function getBirthday(): ?\DateTimeInterface
    //  {
    //      return $this->birthday;
    //  }

    //  public function setBirthday(\DateTimeInterface $birthday): static
    //  {
    //      $this->birthday = $birthday;

    //      return $this;
    //  }

     
     #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
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



    #[Assert\Regex(
        pattern: '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/',
        match: true,
        message: 'Minimum eight characters, at least one upper case English letter, one lower case English letter, one number and one special character'
    )]
    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
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

    
    // Vous devez également implémenter les méthodes requises par UserInterface ici.
    // Par exemple :
    public function getUsername()
    {
        // Retournez le nom d'utilisateur ici.
        return $this->email;
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

    /**
     * @return Collection<int, Adress>
     */
    public function getAdress(): Collection
    {
        return $this->adress;
    }

    public function addAdress(Adress $adress): static
    {
        if (!$this->adress->contains($adress)) {
            // $this->adress->add($adress);
            $this->adress[]=$adress;
            $adress->setUser($this);
        }

        return $this;
    }

    public function removeAdress(Adress $adress): static
    {
        if ($this->adress->contains($adress)) {
            $this->adress->removeElement($adress);
            // set the owning side to null (unless already changed)
            if ($adress->getUser() === $this) {
                $adress->setUser(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getId();
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    
    // public function setCreatedAt(\DateTimeImmutable $CreatedAt): static
    // {
    //     $this->CreatedAt = $CreatedAt;

    //     return $this;
    // }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->CreatedAt = new \DateTimeImmutable();
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->UpdateAt;
    }

    // public function setUpdateAt(\DateTimeImmutable $UpdateAt): static
    // {
    //     $this->UpdateAt = $UpdateAt;

    //     return $this;
    // }
    #[ORM\PrePersist]
    public function setUpdateAtValue(): void
    {
        $this->UpdateAt = new \DateTimeImmutable();
    }
   

    
}

