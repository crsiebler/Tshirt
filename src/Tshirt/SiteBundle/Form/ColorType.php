<?php
// src/Tshirt/SiteBundle/Form/ColorType.php

namespace Tshirt\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * 
 */
class ColorType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name')
                ->add('hexCode');
    }
  
    public function getName()
    {
        return 'tshirt_sitebundle_colortype';
    }
}
?>
