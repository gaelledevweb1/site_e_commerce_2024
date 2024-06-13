<?php

namespace App\Entity;

use App\Repository\CoursGymnastiqueDouceSeniorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursGymnastiqueDouceSeniorRepository::class)]
class CoursGymnastiqueDouceSenior
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // #[ORM\Column(type: Types::DATE_MUTABLE)]
    // private ?\DateTimeInterface $birthday = null;

    // #[ORM\ManyToOne(inversedBy: 'coursGymnastiqueDouceSeniors')]
    // private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'CoursGymnastiqueDouceSenior', targetEntity: Inscription::class)]
    private Collection $inscriptions;

    #[ORM\Column(length: 255)]
    private ?string $nomCours = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $professeur = null;

    #[ORM\Column(type: Types::OBJECT)]
    private ?object $detailCours = null;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getBirthday(): ?\DateTimeInterface
    // {
    //     return $this->birthday;
    // }

    // public function setBirthday(\DateTimeInterface $birthday): static
    // {
    //     $this->birthday = $birthday;

    //     return $this;
    // }

    // public function getUser(): ?User
    // {
    //     return $this->user;
    // }

    // public function setUser(?User $user): static
    // {
    //     $this->user = $user;

    //     return $this;
    // }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): static
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->setCoursGymnastiqueDouceSenior($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getCoursGymnastiqueDouceSenior() === $this) {
                $inscription->setCoursGymnastiqueDouceSenior(null);
            }
        }

        return $this;
    }

    public function getNomCours(): ?string
    {
        return $this->nomCours;
    }

    public function setNomCours(string $nomCours): static
    {
        $this->nomCours = $nomCours;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getProfesseur(): ?string
    {
        return $this->professeur;
    }

    public function setProfesseur(string $professeur): static
    {
        $this->professeur = $professeur;

        return $this;
    }

    public function getDetailCours(): ?object
    {
        return $this->detailCours;
    }

    public function setDetailCours(object $detailCours): static
    {
        $this->detailCours = $detailCours;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getId();
    }
}
