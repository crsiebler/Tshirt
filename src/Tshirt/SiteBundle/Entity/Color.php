<?php
// src/Tshirt/SiteBundle/Entity/Color.php

namespace Tshirt\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * . 
 * 
 * @ORM\Entity
 * @ORM\Table(name="color")
 * @ORM\HasLifeCycleCallbacks()
 */
class Color
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
     * @ORM\Column(type="string", length="7", unique=true)
     * @Assert\NotBlank() 
     */
    protected $hexCode;
    
    public function __construct()
    {
        
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
    
    public function getHexCode()
    {
        return $this->hexCode;
    }

    public function setHexCode($hexCode)
    {
        $this->hexCode = $hexCode;
    }

    public function __toString()
    {
        $result = $this->name;
        return $result;
    }
}
?>
