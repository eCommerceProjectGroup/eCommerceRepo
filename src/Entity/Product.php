<?php
namespace App\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 *
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     */
    private $category;


    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;

  /**
     * @ORM\Column(type="integer")
     */

    private $quantity;



   

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new Assert\Type('string'));
        $metadata->addPropertyConstraint('name', new Assert\NotNull());
        
        $metadata->addPropertyConstraint('description', new Assert\Type('string'));
        $metadata->addPropertyConstraint('description', new Assert\NotNull());
        
        $metadata->addPropertyConstraint('category', new Assert\Type('string'));
        $metadata->addPropertyConstraint('category', new Assert\NotNull());
        
       
        
        $metadata->addPropertyConstraint('price', new Assert\NotNull());
        
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }


    public function getPrice(): ?float
    {
        return $this->price;
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

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

   
    public function setPrice($price)
    {
        $this->price = $price;
    }
}
