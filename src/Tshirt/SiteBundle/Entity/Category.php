<?php
// src/Tshirt/SiteBundle/Entity/Category.php

namespace Tshirt\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * . 
 * 
 * @ORM\Entity()
 * @ORM\Table(name="category")
 * @ORM\HasLifeCycleCallbacks()
 */
class Category
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
     * @ORM\ManyToMany(targetEntity="Design", mappedBy="categories")
     * @ORM\JoinColumn(name="design_id", referencedColumnName="id") 
     */
    protected $designs;
    
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

    public function getDesigns()
    {
        return $this->designs;
    }

    public function setDesigns($designs)
    {
        $this->designs = $designs;
    }
    
    public function __toString()
    {
        $result = $this->name;
        return $result;
    }
}
?>
