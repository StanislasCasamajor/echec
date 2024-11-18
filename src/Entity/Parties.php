<?php

namespace App\Entity;

use App\Repository\PartiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartiesRepository::class)]
class Parties
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $resultat = null;

    #[ORM\Column(length: 50)]
    private ?string $type_partie = null;

    #[ORM\Column(length: 500)]
    private ?string $coups = null;

    /**
     * @var Collection<int, Users>
     */
    #[ORM\ManyToMany(targetEntity: Users::class, mappedBy: 'parties_id')]
    private Collection $users;

    /**
     * @var Collection<int, coups>
     */
    #[ORM\ManyToMany(targetEntity: coups::class, inversedBy: 'parties')]
    private Collection $coup_id;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->coup_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResultat(): ?string
    {
        return $this->resultat;
    }

    public function setResultat(string $resultat): static
    {
        $this->resultat = $resultat;

        return $this;
    }

    public function getTypePartie(): ?string
    {
        return $this->type_partie;
    }

    public function setTypePartie(string $type_partie): static
    {
        $this->type_partie = $type_partie;

        return $this;
    }

    public function getCoups(): ?string
    {
        return $this->coups;
    }

    public function setCoups(string $coups): static
    {
        $this->coups = $coups;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addPartiesId($this);
        }

        return $this;
    }

    public function removeUser(Users $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removePartiesId($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, coups>
     */
    public function getCoupId(): Collection
    {
        return $this->coup_id;
    }

    public function addCoupId(coups $coupId): static
    {
        if (!$this->coup_id->contains($coupId)) {
            $this->coup_id->add($coupId);
        }

        return $this;
    }

    public function removeCoupId(coups $coupId): static
    {
        $this->coup_id->removeElement($coupId);

        return $this;
    }
}
