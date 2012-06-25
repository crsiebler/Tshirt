<?php
// src/Tshirt/SiteBundle/Entity/Design.php

namespace Tshirt\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Tshirt\SiteBundle\Entity\Image;

/**
 * Stores the information for each tshirt design. Contains a many-to-many relationship with the Color entity. 
 * 
 * @ORM\Entity(repositoryClass="Tshirt\SiteBundle\Repository\DesignRepository")
 * @ORM\Table(name="design")
 * @ORM\HasLifeCycleCallbacks()
 */
class Design
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length="128", unique=true)
     * @Assert\NotBlank()
     */
    protected $name;
    
    /**
     * @ORM\Column(type="decimal", precision=19, scale=2)
     * @Assert\NotBlank()
     */
    protected $price;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $isPopular;
    
    /**
     * @ORM\ManyToMany(targetEntity="Image", cascade={"all"})
     */
    protected $images;
    
    /**
     * @ORM\ManyToMany(targetEntity="Color")
     */
    protected $colors;
    
    /**
     * @ORM\ManyToOne(targetEntity="Category") 
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $categories;
    
    public function __construct()
    {
        $this->colors = new ArrayCollection();
        $this->images = new ArrayCollection();

        $this->setCreated(new \DateTime());
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }
    
    /**
     * This function returns the original design price with an additional $2.00
     * due to the size of the shirt.
     * 
     * @return double
     */
    public function getAdditionalPrice()
    {
        return (double) $this->price + 2.00;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        $this->created = $created;
    }

    public function getIsPopular()
    {
        return $this->isPopular;
    }

    public function setIsPopular($isPopular)
    {
        $this->isPopular = $isPopular;
    }
    
    public function getImages()
    {
        return $this->images;
    }

    public function setImages($images)
    {
        $this->images = $images;
    }
    
    /**
     * This function adds an image to the design. Can be a product image or a customer
     * uploaded image.
     * 
     * @param Image $image 
     */
    public function addImage(Image $image)
    {
        $this->images->add($image);
    }
    
    public function getColors()
    {
        return $this->colors;
    }

    public function setColors($colors)
    {
        $this->colors = $colors;
    }
    
    public function getCategories()
    {
        return $this->categories;
    }

    public function setCategories($categories)
    {
        $this->categories = $categories;
    }
    
    public function __toString()
    {
        $result = $this->name;
        return $result;
    }
}
?>
