<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ItemsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ItemsRepository::class)]
#[ApiResource(normalizationContext: ["groups" => ["items:read"]])]
class Items
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('items:read')]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups('items:read')]
    private ?float $price = null;

    #[ORM\Column]
    #[Groups('items:read')]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'Items')]
    private ?ServiceProduct $serviceProduct = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    private ?StatusItems $statusItems = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    private ?Order $orderItems = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getServiceProduct(): ?ServiceProduct
    {
        return $this->serviceProduct;
    }

    public function setServiceProduct(?ServiceProduct $serviceProduct): static
    {
        $this->serviceProduct = $serviceProduct;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
