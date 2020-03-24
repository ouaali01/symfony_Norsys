<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity( repositoryClass="App\Repository\OrderdetailRepository")
 */
class Orderdetail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Product", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Order", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $prodorder;

    /**
     * Orderdetail constructor.
     * @param $quantity
     * @param $product
     * @param $prodorder
     */
    public function __construct($quantity, $product, $prodorder)
    {
        $this->quantity = $quantity;
        $this->product = $product;
        $this->prodorder = $prodorder;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product): void
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getProdorder()
    {
        return $this->prodorder;
    }

    /**
     * @param mixed $prodorder
     */
    public function setProdorder($prodorder): void
    {
        $this->prodorder = $prodorder;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
    }


}
