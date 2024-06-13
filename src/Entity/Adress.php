<?php

namespace App\Entity;

use App\Repository\AdressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AdressRepository::class)]
class Adress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    

    #[ORM\Column(length: 255)]
    private ?string $City = null;

    #[ORM\Column]
    private ?int $Zip = null;

    #[ORM\Column(length: 255)]
    private ?string $Country = null;

    #[ORM\ManyToOne(inversedBy: 'adress', targetEntity: User::class, cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column(length: 255)]
    private ?string $street = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

     
    public function getId(): ?int
    {
        return $this->id;
    }

    

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): static
    {
        $this->City = $City;

        return $this;
    }

    #[Assert\PositiveOrZero]
    public function getZip(): ?int
    {
        return $this->Zip;
    }

    
    public function setZip(int $Zip): static
    {
        $this->Zip = $Zip;

        return $this;
    }

    
    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(string $Country): static
    {
        $this->Country = $Country;

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

    #[Assert\Positive]
    public function getNumber(): ?int
    {
        return $this->number;
    }

    
    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    #[Assert\Sequentially([
        new Assert\NotNull,
        new Assert\Type('string'),
        new Assert\Length(min: 4, max:20),
        
        
    ])]
    public function getStreet(): ?string
    {
        return $this->street;
    }

    
    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }
    public function __toString()
    {
        
        // return $this->getId();
        return $this->getNumber() . ' ' . $this->getStreet() . ' ' . $this->getCity() . ' ' . $this->getZip() . ' ' . $this->getCountry();
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

     
}
