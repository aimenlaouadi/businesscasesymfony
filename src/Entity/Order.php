<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['order:read']],
)]
#[ORM\Table(name: "`order`")]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['order:read', 'user:read'])]

    private ?int $id = null;



    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['order:read', 'user:read'])]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(mappedBy: 'orderItems', targetEntity: Items::class, cascade: ['persist', 'remove'])]
    #[Groups(['order:read', 'user:read'])]
    private Collection $items;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['order:read'])]
    private ?User $user = null;
    

    #[ORM\Column(length: 255)]
    #[Groups(['order:read', 'user:read'])]

    private ?string $depotDate = null;

    #[ORM\Column(length: 255)]
    #[Groups(['order:read', 'user:read'])]

    private ?string $paymentMethod = null;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

 

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

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
            $item->setOrderItems($this); // Assurez-vous que setOrderItems() existe dans Items
        }

        return $this;
    }

    public function removeItem(Items $item): static
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getOrderItems() === $this) {
                $item->setOrderItems(null); // Assurez-vous que setOrderItems() existe dans Items
            }
        }

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

    public function getDepotDate(): ?string
    {
        return $this->depotDate;
    }

    public function setDepotDate(string $depotDate): static
    {
        $this->depotDate = $depotDate;

        return $this;
    }

    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(string $paymentMethod): static
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }
}
