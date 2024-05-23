<?php

namespace App\Entity;

use App\Repository\AdressRepository;
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

    #[ORM\ManyToOne(inversedBy: 'adress', targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column(length: 255)]
    private ?string $street = null;

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
        return $this->getId();
    }
}
