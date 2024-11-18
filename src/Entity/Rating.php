<?php

namespace App\Entity;

use App\Repository\RatingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RatingRepository::class)]
class Rating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $rating_bullet = null;

    #[ORM\Column(nullable: true)]
    private ?int $rating_blitz = null;

    #[ORM\Column(nullable: true)]
    private ?int $rating_rapide = null;

    #[ORM\ManyToOne(inversedBy: 'ratings')]
    private ?users $user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRatingBullet(): ?int
    {
        return $this->rating_bullet;
    }

    public function setRatingBullet(?int $rating_bullet): static
    {
        $this->rating_bullet = $rating_bullet;

        return $this;
    }

    public function getRatingBlitz(): ?int
    {
        return $this->rating_blitz;
    }

    public function setRatingBlitz(?int $rating_blitz): static
    {
        $this->rating_blitz = $rating_blitz;

        return $this;
    }

    public function getRatingRapide(): ?int
    {
        return $this->rating_rapide;
    }

    public function setRatingRapide(?int $rating_rapide): static
    {
        $this->rating_rapide = $rating_rapide;

        return $this;
    }

    public function getUserId(): ?users
    {
        return $this->user_id;
    }

    public function setUserId(?users $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }
}
