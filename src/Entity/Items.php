<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ItemsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ItemsRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['items:read']],
)]
class Items
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['items:read', 'user:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['items:read', 'user:read'])]
    private ?float $price = null;

    #[ORM\Column]
    #[Groups(['items:read', 'user:read'])]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: true)] // Ajout de JoinColumn pour éviter les erreurs de clé étrangère
    #[Groups(['items:read', 'user:read'])]
    private ?StatusItems $statusItems = null;

    #[ORM\ManyToOne(inversedBy: 'items', cascade: ['persist'], fetch: 'EAGER')]
    #[ORM\JoinColumn(nullable: false)]
   
    private ?Order $orderItems = null;



    #[ORM\ManyToOne(inversedBy: 'items')]
    #[Groups(['items:read', 'user:read'])]
    private ?Service $service = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[Groups(['items:read', 'user:read'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    private ?Employee $employee = null;

    // Getters et Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getStatusItems(): ?StatusItems
    {
        return $this->statusItems;
    }

    public function setStatusItems(?StatusItems $statusItems): static
    {
        $this->statusItems = $statusItems;

        return $this;
    }

    public function getOrderItems(): ?Order
    {
        return $this->orderItems;
    }

    public function setOrderItems(?Order $orderItems): static
    {
        $this->orderItems = $orderItems;

        return $this;
    }

 

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): static
    {
        $this->service = $service;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): static
    {
        $this->employee = $employee;

        return $this;
    }
}
