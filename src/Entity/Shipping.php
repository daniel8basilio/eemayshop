<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShippingRepository")
 * @ORM\Table(name="tbl_shippings")
 */
class Shipping
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $address;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $contact_number;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $postal_code;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, options={"default": 0})
     */
    private $fee;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $shipping_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $cancel_date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $receive_date;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $tracking_code;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $remarks;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
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

    public function getContactNumber(): ?string
    {
        return $this->contact_number;
    }

    public function setContactNumber(string $contact_number): self
    {
        $this->contact_number = $contact_number;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(?string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getFee()
    {
        return $this->fee;
    }

    public function setFee($fee): self
    {
        $this->fee = $fee;

        return $this;
    }

    public function getShippingDate(): ?\DateTimeInterface
    {
        return $this->shipping_date;
    }

    public function setShippingDate(?\DateTimeInterface $shipping_date): self
    {
        $this->shipping_date = $shipping_date;

        return $this;
    }

    public function getCancelDate(): ?\DateTimeInterface
    {
        return $this->cancel_date;
    }

    public function setCancelDate(?\DateTimeInterface $cancel_date): self
    {
        $this->cancel_date = $cancel_date;

        return $this;
    }

    public function getReceiveDate(): ?\DateTimeInterface
    {
        return $this->receive_date;
    }

    public function setReceiveDate(?\DateTimeInterface $receive_date): self
    {
        $this->receive_date = $receive_date;

        return $this;
    }

    public function getTrackingCode(): ?string
    {
        return $this->tracking_code;
    }

    public function setTrackingCode(?string $tracking_code): self
    {
        $this->tracking_code = $tracking_code;

        return $this;
    }

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    public function setRemarks(?string $remarks): self
    {
        $this->remarks = $remarks;

        return $this;
    }
}
