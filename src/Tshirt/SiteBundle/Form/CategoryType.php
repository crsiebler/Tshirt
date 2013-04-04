<?php
// src/Tshirt/SiteBundle/Form/CategoryType.php

namespace Tshirt\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * 
 */
class CategoryType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name');
    }
  
    public function getName()
    {
        return 'tshirt_sitebundle_categorytype';
    }
}
?>
