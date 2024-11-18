<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $username = null;

    #[ORM\Column(length: 50)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password_hash = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_inscription = null;

    #[ORM\Column(length: 50)]
    private ?string $pays = null;

    /**
     * @var Collection<int, contacts>
     */
    #[ORM\ManyToMany(targetEntity: contacts::class, inversedBy: 'users')]
    private Collection $contact_id;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?messages $message_id = null;

    /**
     * @var Collection<int, Rating>
     */
    #[ORM\OneToMany(targetEntity: Rating::class, mappedBy: 'user_id')]
    private Collection $ratings;

    /**
     * @var Collection<int, parties>
     */
    #[ORM\ManyToMany(targetEntity: parties::class, inversedBy: 'users')]
    private Collection $parties_id;

    public function __construct()
    {
        $this->contact_id = new ArrayCollection();
        $this->ratings = new ArrayCollection();
        $this->parties_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPasswordHash(): ?string
    {
        return $this->password_hash;
    }

    public function setPasswordHash(string $password_hash): static
    {
        $this->password_hash = $password_hash;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTimeInterface $date_inscription): static
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection<int, contacts>
     */
    public function getContactId(): Collection
    {
        return $this->contact_id;
    }

    public function addContactId(contacts $contactId): static
    {
        if (!$this->contact_id->contains($contactId)) {
            $this->contact_id->add($contactId);
        }

        return $this;
    }

    public function removeContactId(contacts $contactId): static
    {
        $this->contact_id->removeElement($contactId);

        return $this;
    }

    public function getMessageId(): ?messages
    {
        return $this->message_id;
    }

    public function setMessageId(?messages $message_id): static
    {
        $this->message_id = $message_id;

        return $this;
    }

    /**
     * @return Collection<int, Rating>
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(Rating $rating): static
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings->add($rating);
            $rating->setUserId($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): static
    {
        if ($this->ratings->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getUserId() === $this) {
                $rating->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, parties>
     */
    public function getPartiesId(): Collection
    {
        return $this->parties_id;
    }

    public function addPartiesId(parties $partiesId): static
    {
        if (!$this->parties_id->contains($partiesId)) {
            $this->parties_id->add($partiesId);
        }

        return $this;
    }

    public function removePartiesId(parties $partiesId): static
    {
        $this->parties_id->removeElement($partiesId);

        return $this;
    }
}
