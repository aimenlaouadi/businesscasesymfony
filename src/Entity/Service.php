<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[ApiResource(normalizationContext: ["groups" => ["service:read"]])]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['service:read', 'product:read'])] // Ajouté pour inclure l'ID dans les réponses de produit et service
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['service:read', 'product:read'])] // Ajouté pour inclure dans les réponses de produit et service
    private ?string $service_type = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['service:read', 'product:read'])] // Ajouté pour inclure dans les réponses de produit et service
    private ?float $service_price = null;

    #[ORM\Column(length: 255)]
    #[Groups(['service:read', 'product:read'])] // Ajouté pour inclure dans les réponses de produit et service
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups(['service:read', 'product:read'])] // Ajouté pour inclure dans les réponses de produit et service
    private ?string $images = null;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'services')]
    #[Groups('service:read')] // Ajouté pour inclure la liste des produits associés dans les réponses de service
    private Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->addService($this); // Assurer la relation bidirectionnelle
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->products->removeElement($product)) {
            $product->removeService($this); // Assurer la relation bidirectionnelle
        }

        return $this;
    }
}
