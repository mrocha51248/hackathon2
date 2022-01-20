<?php

namespace App\Entity;

use App\Repository\SubscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriptionRepository::class)]
class Subscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'date')]
    private $nextDelivery;

    #[ORM\Column(type: 'dateinterval')]
    private $period;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'subscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\OneToMany(mappedBy: 'subscription', targetEntity: SubscriptionProduct::class, orphanRemoval: true)]
    private $subscriptionProducts;

    public function __construct()
    {
        $this->subscriptionProducts = new ArrayCollection();
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

    public function getNextDelivery(): ?\DateTimeInterface
    {
        return $this->nextDelivery;
    }

    public function setNextDelivery(\DateTimeInterface $nextDelivery): self
    {
        $this->nextDelivery = $nextDelivery;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPeriod(): ?\DateInterval
    {
        return $this->period;
    }

    public function setPeriod(\DateInterval $period): self
    {
        $this->period = $period;

        return $this;
    }

    /**
     * @return Collection|SubscriptionProduct[]
     */
    public function getSubscriptionProducts(): Collection
    {
        return $this->subscriptionProducts;
    }

    public function addSubscriptionProduct(SubscriptionProduct $subscriptionProduct): self
    {
        if (!$this->subscriptionProducts->contains($subscriptionProduct)) {
            $this->subscriptionProducts[] = $subscriptionProduct;
            $subscriptionProduct->setSubscription($this);
        }

        return $this;
    }

    public function removeSubscriptionProduct(SubscriptionProduct $subscriptionProduct): self
    {
        if ($this->subscriptionProducts->removeElement($subscriptionProduct)) {
            // set the owning side to null (unless already changed)
            if ($subscriptionProduct->getSubscription() === $this) {
                $subscriptionProduct->setSubscription(null);
            }
        }

        return $this;
    }
}
