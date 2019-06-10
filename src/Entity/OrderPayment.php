<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderPaymentRepository")
 * @ORM\Table(name="tbl_order_payments")
 */
class OrderPayment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, options={"default": 0})
     */
    private $amount;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $payment_date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="payments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $RelatedOrder;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PaymentMethod")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Method;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getPaymentDate(): ?\DateTimeInterface
    {
        return $this->payment_date;
    }

    public function setPaymentDate(\DateTimeInterface $payment_date): self
    {
        $this->payment_date = $payment_date;

        return $this;
    }

    public function getRelatedOrder(): ?Order
    {
        return $this->RelatedOrder;
    }

    public function setRelatedOrder(?Order $RelatedOrder): self
    {
        $this->RelatedOrder  = $RelatedOrder;

        return $this;
    }

    public function getMethod(): ?PaymentMethod
    {
        return $this->Method;
    }

    public function setMethod(?PaymentMethod $Method): self
    {
        $this->Method = $Method;

        return $this;
    }
}
