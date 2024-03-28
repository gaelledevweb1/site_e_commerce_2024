<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaiementRepository::class)]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $bankName = null;

    #[ORM\Column(length: 255)]
    private ?string $cardName = null;

    #[ORM\Column(length: 255)]
    private ?string $cardNumber = null;

    #[ORM\Column(length: 255)]
    private ?string $cardNetwork = null;

    #[ORM\Column(length: 255)]
    private ?string $cardHoldername = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $expirationDate = null;

    #[ORM\Column]
    private ?int $CVCCode = null;

    #[ORM\Column(length: 255)]
    private ?string $securityCard = null;

    #[ORM\Column(length: 255)]
    private ?string $currency = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    public function setBankName(string $bankName): static
    {
        $this->bankName = $bankName;

        return $this;
    }

    public function getCardName(): ?string
    {
        return $this->cardName;
    }

    public function setCardName(string $cardName): static
    {
        $this->cardName = $cardName;

        return $this;
    }

    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    public function setCardNumber(string $cardNumber): static
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    public function getCardNetwork(): ?string
    {
        return $this->cardNetwork;
    }

    public function setCardNetwork(string $cardNetwork): static
    {
        $this->cardNetwork = $cardNetwork;

        return $this;
    }

    public function getCardHoldername(): ?string
    {
        return $this->cardHoldername;
    }

    public function setCardHoldername(string $cardHoldername): static
    {
        $this->cardHoldername = $cardHoldername;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(\DateTimeInterface $expirationDate): static
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    public function getCVCCode(): ?int
    {
        return $this->CVCCode;
    }

    public function setCVCCode(int $CVCCode): static
    {
        $this->CVCCode = $CVCCode;

        return $this;
    }

    public function getSecurityCard(): ?string
    {
        return $this->securityCard;
    }

    public function setSecurityCard(string $securityCard): static
    {
        $this->securityCard = $securityCard;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }
}



