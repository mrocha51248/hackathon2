<?php

namespace App\Entity;

use App\Repository\ScoreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScoreRepository::class)]
class Score
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $score;

    #[ORM\ManyToOne(targetEntity: Expertise::class, inversedBy: 'productscore')]
    #[ORM\JoinColumn(nullable: false)]
    private $job;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'score')]
    #[ORM\JoinColumn(nullable: false)]
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getJob(): ?Expertise
    {
        return $this->job;
    }

    public function setJob(?Expertise $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
