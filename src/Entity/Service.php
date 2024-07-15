<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ServiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
#[ApiResource]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $service_type = null;

    #[ORM\Column(nullable: true)]
    private ?float $service_coef = null;

    #[ORM\Column(nullable: true)]
    private ?float $service_price = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServiceType(): ?string
    {
        return $this->service_type;
    }

    public function setServiceType(string $service_type): static
    {
        $this->service_type = $service_type;

        return $this;
    }

    public function getServiceCoef(): ?float
    {
        return $this->service_coef;
    }

    public function setServiceCoef(?float $service_coef): static
    {
        $this->service_coef = $service_coef;

        return $this;
    }

    public function getServicePrice(): ?float
    {
        return $this->service_price;
    }

    public function setServicePrice(?float $service_price): static
    {
        $this->service_price = $service_price;

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
}
