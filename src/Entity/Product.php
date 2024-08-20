<?php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(normalizationContext: ["groups"=>["products:read"]])]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('products:read')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups('products:read')]
    private ?string $product_name = null;

    #[ORM\Column(length: 255)]
    #[Groups('products:read')]
    private ?string $product_description = null;


    private Collection $services; // Renommé de Service à services

    public function __construct()
    {
        $this->services = new ArrayCollection(); // Renommé de Service à services
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function setProductName(string $product_name): static
    {
        $this->product_name = $product_name;

        return $this;
    }

    public function getProductDescription(): ?string
    {
        return $this->product_description;
    }

    public function setProductDescription(string $product_description): static
    {
        $this->product_description = $product_description;

        return $this;
    }


  
    public function getServices(): Collection // Renommé de getService à getServices
    {
        return $this->services;
    }

    public function addService($service): static
    {
        if (!$this->services->contains($service)) { // Renommé de Service à services
            $this->services->add($service); // Renommé de Service à services
            $service->setProduct($this);
        }

        return $this;
    }

    public function removeService($service): static
    {
        if ($this->services->removeElement($service)) { // Renommé de Service à services
            // set the owning side to null (unless already changed)
            if ($service->getProduct() === $this) {
                $service->setProduct(null);
            }
        }

        return $this;
    }
}
