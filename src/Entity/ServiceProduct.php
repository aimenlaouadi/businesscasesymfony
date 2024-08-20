<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ServiceProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ServiceProductRepository::class)]
#[ApiResource(normalizationContext: ["groups" => ["serviceProducts:read"]])]
class ServiceProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('serviceProducts:read')]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups('serviceProducts:read')]
    private ?float $coef = null;

    #[ORM\ManyToOne(inversedBy: 'serviceProducts')]
    #[Groups('serviceProducts:read')]
    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'serviceProducts')]
    #[Groups('serviceProducts:read')]
    private ?Service $service = null;

    /**
     * @var Collection<int, Items>
     */
    #[ORM\OneToMany(mappedBy: 'serviceProduct', targetEntity: Items::class)]
    #[Groups('serviceProducts:read')]
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoef(): ?float
    {
        return $this->coef;
    }

    public function setCoef(float $coef): static
    {
        $this->coef = $coef;

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

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): static
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return Collection<int, Items>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Items $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setServiceProduct($this);
        }

        return $this;
    }

    public function removeItem(Items $item): static
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getServiceProduct() === $this) {
                $item->setServiceProduct(null);
            }
        }

        return $this;
    }
}
