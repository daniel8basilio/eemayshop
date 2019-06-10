<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderDetailRepository")
 * @ORM\Table(name="tbl_order_details")
 */
class OrderDetail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    private $quantity;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0, options={"default": 0})
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="details")
     * @ORM\JoinColumn(nullable=false)
     */
    private $RelatedOrder;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getRelatedOrder(): ?Order
    {
        return $this->RelatedOrder;
    }

    public function setRelatedOrder(?Order $RelatedOrder): self
    {
        $this->RelatedOrder = $RelatedOrder;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->Product;
    }

    public function setProduct(Product $Product): self
    {
        $this->Product = $Product;

        return $this;
    }
}
