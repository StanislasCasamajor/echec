<?php

namespace App\Entity;

use App\Repository\CoupsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoupsRepository::class)]
class Coups
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero_coup = null;

    #[ORM\Column(length: 500)]
    private ?string $coup = null;

    /**
     * @var Collection<int, Parties>
     */
    #[ORM\ManyToMany(targetEntity: Parties::class, mappedBy: 'coup_id')]
    private Collection $parties;

    public function __construct()
    {
        $this->parties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCoup(): ?int
    {
        return $this->numero_coup;
    }

    public function setNumeroCoup(int $numero_coup): static
    {
        $this->numero_coup = $numero_coup;

        return $this;
    }

    public function getCoup(): ?string
    {
        return $this->coup;
    }

    public function setCoup(string $coup): static
    {
        $this->coup = $coup;

        return $this;
    }

    /**
     * @return Collection<int, Parties>
     */
    public function getParties(): Collection
    {
        return $this->parties;
    }

    public function addParty(Parties $party): static
    {
        if (!$this->parties->contains($party)) {
            $this->parties->add($party);
            $party->addCoupId($this);
        }

        return $this;
    }

    public function removeParty(Parties $party): static
    {
        if ($this->parties->removeElement($party)) {
            $party->removeCoupId($this);
        }

        return $this;
    }
}
