<?php
// src/Tshirt/SiteBundle/Form/DesignType.php

namespace Tshirt\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * 
 */
class DesignType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name')
                ->add('price')
                ->add('isPopular', null, array('required' => false))
                ->add('colors', 'entity', array('class' => 'TshirtSiteBundle:Color', 'required' => true, 'multiple' => true))
                ->add('categories', 'entity', array('class' => 'TshirtSiteBundle:Category', 'required' => true));
    }
  
    public function getName()
    {
        return 'tshirt_sitebundle_designtype';
    }
}
?>
