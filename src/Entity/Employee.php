<?php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource()]
class Employee extends User
{
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $position = null;

    /**
     * @var Collection<int, Items>
     */
    #[ORM\OneToMany(targetEntity: Items::class, mappedBy: 'employee')]
    private Collection $items;

    public function __construct()
    {
        parent::__construct();
        $this->items = new ArrayCollection();
    }

    public function __tostring(){
        return $this->getUsername();
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): static
    {
        $this->position = $position;
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
            $item->setEmployee($this);
        }

        return $this;
    }

    public function removeItem(Items $item): static
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getEmployee() === $this) {
                $item->setEmployee(null);
            }
        }

        return $this;
    }

}
