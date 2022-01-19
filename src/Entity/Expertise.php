<?php

namespace App\Entity;

use App\Repository\ExpertiseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExpertiseRepository::class)]
class Expertise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'job', targetEntity: User::class)]
    private $users;

    #[ORM\OneToMany(mappedBy: 'job', targetEntity: Score::class)]
    private $productscore;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->productscore = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setJob($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getJob() === $this) {
                $user->setJob(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Score[]
     */
    public function getProductscore(): Collection
    {
        return $this->productscore;
    }

    public function addProductscore(Score $productscore): self
    {
        if (!$this->productscore->contains($productscore)) {
            $this->productscore[] = $productscore;
            $productscore->setJob($this);
        }

        return $this;
    }

    public function removeProductscore(Score $productscore): self
    {
        if ($this->productscore->removeElement($productscore)) {
            // set the owning side to null (unless already changed)
            if ($productscore->getJob() === $this) {
                $productscore->setJob(null);
            }
        }

        return $this;
    }
}
