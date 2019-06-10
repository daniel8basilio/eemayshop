<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="tbl_orders")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $customer_name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $customer_email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $customer_contact_number;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $payment_due_date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderDetail", mappedBy="RelatedOrder")
     */
    private $details;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderPayment", mappedBy="RelatedOrder")
     */
    private $payments;

    public function __construct()
    {
        $this->details = new ArrayCollection();
        $this->payments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerName(): ?string
    {
        return $this->customer_name;
    }

    public function setCustomerName(?string $customer_name): self
    {
        $this->customer_name = $customer_name;

        return $this;
    }

    public function getCustomerEmail(): ?string
    {
        return $this->customer_email;
    }

    public function setCustomerEmail(?string $customer_email): self
    {
        $this->customer_email = $customer_email;

        return $this;
    }

    public function getCustomerContactNumber(): ?string
    {
        return $this->customer_contact_number;
    }

    public function setCustomerContactNumber(?string $customer_contact_number): self
    {
        $this->customer_contact_number = $customer_contact_number;

        return $this;
    }

    public function getPaymentDueDate(): ?\DateTimeInterface
    {
        return $this->payment_due_date;
    }

    public function setPaymentDueDate(?\DateTimeInterface $payment_due_date): self
    {
        $this->payment_due_date = $payment_due_date;

        return $this;
    }

    /**
     * @return Collection|OrderDetail[]
     */
    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function addDetail(OrderDetail $detail): self
    {
        if (!$this->details->contains($detail)) {
            $this->details[] = $detail;
            $detail->setRelatedOrder($this);
        }

        return $this;
    }

    public function removeDetail(OrderDetail $detail): self
    {
        if ($this->details->contains($detail)) {
            $this->details->removeElement($detail);
            // set the owning side to null (unless already changed)
            if ($detail->getRelatedOrder() === $this) {
                $detail->setRelatedOrder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OrderPayment[]
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(OrderPayment $payment): self
    {
        if (!$this->payments->contains($payment)) {
            $this->payments[] = $payment;
            $payment->setRelatedOrder($this);
        }

        return $this;
    }

    public function removePayment(OrderPayment $payment): self
    {
        if ($this->payments->contains($payment)) {
            $this->payments->removeElement($payment);
            // set the owning side to null (unless already changed)
            if ($payment->getRelatedOrder() === $this) {
                $payment->setRelatedOrder(null);
            }
        }

        return $this;
    }
}
