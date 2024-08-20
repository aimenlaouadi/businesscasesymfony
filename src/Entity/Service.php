<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ServiceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
#[ApiResource(normalizationContext: ["groups" => ["services:read"]])]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('services:read')]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    #[Groups('services:read')]
    private ?string $service_type = null;

    #[ORM\Column(nullable: true)]
    #[Groups('services:read')]
    private ?float $service_price = null;

    #[ORM\Column(length: 255)]
    #[Groups('services:read')]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups('services:read')]
    private ?string $images = null;

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

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(string $images): static
    {
        $this->images = $images;

        return $this;
    }
}
