<?php

namespace App\Entity;

use App\Repository\DeviRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeviRepository::class)
 */
class Devi
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $email;

    /**
     * @ORM\Column(type="date")
     */
    private $created_At;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $montage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $depannage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $equilibre;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $valve;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $plaquette;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $disque;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $vidange;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $price;

    public function __construct()
    {
        $this->created_At = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_At;
    }

    public function setCreatedAt(\DateTimeInterface $created_At): self
    {
        $this->created_At = $created_At;

        return $this;
    }

    public function getMontage(): ?bool
    {
        return $this->montage;
    }

    public function setMontage(?bool $montage): self
    {
        $this->montage = $montage;

        return $this;
    }

    public function getDepannage(): ?bool
    {
        return $this->depannage;
    }

    public function setDepannage(?bool $depannage): self
    {
        $this->depannage = $depannage;

        return $this;
    }

    public function getEquilibre(): ?bool
    {
        return $this->equilibre;
    }

    public function setEquilibre(?bool $equilibre): self
    {
        $this->equilibre = $equilibre;

        return $this;
    }

    public function getValve(): ?bool
    {
        return $this->valve;
    }

    public function setValve(?bool $valve): self
    {
        $this->valve = $valve;

        return $this;
    }

    public function getPlaquette(): ?bool
    {
        return $this->plaquette;
    }

    public function setPlaquette(?bool $plaquette): self
    {
        $this->plaquette = $plaquette;

        return $this;
    }

    public function getDisque(): ?bool
    {
        return $this->disque;
    }

    public function setDisque(?bool $disque): self
    {
        $this->disque = $disque;

        return $this;
    }

    public function getVidange(): ?bool
    {
        return $this->vidange;
    }

    public function setVidange(?bool $vidange): self
    {
        $this->vidange = $vidange;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }
}
