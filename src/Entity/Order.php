<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $orderDate = null;

    #[ORM\Column]
    private ?bool $paid = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?bool $delivered = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $deliveryDate = null;

    #[ORM\Column(length: 255)]
    private ?string $deliveryInfo = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @var string A "Y-m-d H:i:s" formatted value
     */
    #[Assert\DateTime]
    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): static
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function isPaid(): ?bool
    {
        return $this->paid;
    }

    public function setPaid(bool $paid): static
    {
        $this->paid = $paid;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function isDelivered(): ?bool
    {
        return $this->delivered;
    }

    public function setDelivered(bool $delivered): static
    {
        $this->delivered = $delivered;

        return $this;
    }

     /**
     * @var string A "Y-m-d H:i:s" formatted value
     */
    #[Assert\DateTime]
    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->deliveryDate;
        
    }

    public function setDeliveryDate(\DateTimeInterface $deliveryDate): static
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    public function getDeliveryInfo(): ?string
    {
        return $this->deliveryInfo;
    }

    public function setDeliveryInfo(string $deliveryInfo): static
    {
        $this->deliveryInfo = $deliveryInfo;

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

    public function __toString(): string
    {
        return $this->getId();
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }
}
