<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $username;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Order::class, orphanRemoval: true)]
    private $orders;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Subscription::class)]
    private $subscription;

    #[ORM\ManyToOne(targetEntity: Expertise::class, inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private $job;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->subscription = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setUser($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getUser() === $this) {
                $order->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Subscription[]
     */
    public function getSubscription(): Collection
    {
        return $this->subscription;
    }

    public function addSubscription(Subscription $subscription): self
    {
        if (!$this->subscription->contains($subscription)) {
            $this->subscription[] = $subscription;
            $subscription->setUser($this);
        }

        return $this;
    }

    public function removeSubscription(Subscription $subscription): self
    {
        if ($this->subscription->removeElement($subscription)) {
            // set the owning side to null (unless already changed)
            if ($subscription->getUser() === $this) {
                $subscription->setUser(null);
            }
        }

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
}
