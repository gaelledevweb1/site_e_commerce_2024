<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $articleRef = null;

    #[ORM\Column(length: 255)]
    private ?string $articleName = null;

    #[ORM\Column(length: 255)]
    private ?string $articleImages = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $articleThumbnails = null;

    #[ORM\Column]
    private ?int $articleStockQuantity = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $articleDescription = null;

    #[ORM\Column]
    private ?float $boughtPrice = null;

    #[ORM\Column]
    private ?float $sellPriceHT = null;

    #[ORM\Column]
    private ?float $sellPriceTTC = null;

    #[ORM\Column]
    private ?float $TVA = null;

    #[ORM\Column(length: 255)]
    private ?string $details = null;

    

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?Category $category = null;

    
    

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticleRef(): ?string
    {
        return $this->articleRef;
    }

    public function setArticleRef(string $articleRef): static
    {
        $this->articleRef = $articleRef;

        return $this;
    }

    public function getArticleName(): ?string
    {
        return $this->articleName;
    }

    public function setArticleName(string $articleName): static
    {
        $this->articleName = $articleName;

        return $this;
    }

    public function getArticleImages(): ?string
    {
        return $this->articleImages;
    }

    public function setArticleImages(string $articleImages): static
    {
        $this->articleImages = $articleImages;

        return $this;
    }

    public function getArticleThumbnails(): ?string
    {
        return $this->articleThumbnails;
    }

    public function setArticleThumbnails(?string $articleThumbnails): static
    {
        $this->articleThumbnails = $articleThumbnails;

        return $this;
    }

    public function getArticleStockQuantity(): ?int
    {
        return $this->articleStockQuantity;
    }

    public function setArticleStockQuantity(int $articleStockQuantity): static
    {
        $this->articleStockQuantity = $articleStockQuantity;

        return $this;
    }

    public function getArticleDescription(): ?string
    {
        return $this->articleDescription;
    }

    public function setArticleDescription(string $articleDescription): static
    {
        $this->articleDescription = $articleDescription;

        return $this;
    }

    public function getBoughtPrice(): ?float
    {
        return $this->boughtPrice;
    }

    public function setBoughtPrice(float $boughtPrice): static
    {
        $this->boughtPrice = $boughtPrice;

        return $this;
    }

    public function getSellPriceHT(): ?float
    {
        return $this->sellPriceHT;
    }

    public function setSellPriceHT(float $sellPriceHT): static
    {
        $this->sellPriceHT = $sellPriceHT;

        return $this;
    }

    public function getSellPriceTTC(): ?float
    {
        // {% set sellPriceTTC = product.sellPriceHT * (1 + product.TVA / 100) %}
        // return $this->sellPriceTTC;
        return $this-> sellPriceHT * (1 +$this->TVA / 100);
    }

    public function setSellPriceTTC(float $sellPriceTTC): static
    {
        $this->sellPriceTTC = $sellPriceTTC;

        return $this;
    }

    public function getTVA(): ?float
    {
        return $this->TVA;
    }

    public function setTVA(float $TVA): static
    {
        $this->TVA = $TVA;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): static
    {
        $this->details = $details;

        return $this;
    }

    
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    
    

    
}
