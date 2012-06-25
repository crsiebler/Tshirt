<?php
// src/Tshirt/SiteBundle/Form/ImageType.php

namespace Tshirt\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * 
 */
class ImageType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('uploadedFile', 'file', array('required' => true));
    }
  
    public function getName()
    {
        return 'tshirt_sitebundle_imagetype';
    }
}
?>
