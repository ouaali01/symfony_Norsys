<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Category;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(max=25)
     */
    private $name;
//  * @Assert\Currency
    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     * @Assert\NotBlank
     * message = "La valeur entrée dans le champ prix est invalide."
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\Range(
     *      min = 10,
     *      max = 10000,
     * )
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=100)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageURL;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $createAt;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Category", cascade={"persist", "remove"})
     */
    private $category;
/*
    /**
     * Product constructor.
     * @param $name
     * @param $price
     * @param $quantity
     * @param $description
     * @param $imageURL
     * @param $createAt
     */
    /*
    public function __construct($name, $price, $quantity, $description, $imageURL)
    {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->description = $description;
        $this->imageURL = $imageURL;
        $this->createAt = date('d-m-y');
    }*/

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice( $price): void
    {
        $this->price = (int) $price;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getImageURL()
    {
        return $this->imageURL;
    }

    /**
     * @param mixed $imageURL
     */
    public function setImageURL($imageURL): void
    {
        $this->imageURL = $imageURL;
    }

    /**
     * @return mixed
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * @param mixed $createAt
     */
    public function setCreateAt($createAt): void
    {
        $this->createAt = $createAt;
    }


    public function __toString()
    {
     return  $this->getName();
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }


}
