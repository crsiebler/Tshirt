<?php
// src/Tshirt/SiteBundle/Controller/ColorController.php

namespace Tshirt\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tshirt\SiteBundle\Entity\Color;
use Tshirt\SiteBundle\Form\ColorType;

/**
 * 
 */
class ColorController extends Controller
{
    /**
     * This function displays the form to add colors and persists the request into the database.
     * 
     * @return html.twig
     */
    public function addAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $color = new Color();
        
        $request = $this->getRequest();
        $form = $this->createForm(new ColorType, $color);
        
        if($request->getMethod() == "POST")
        {
            $form->bindRequest($request);
            
            if($form->isValid())
            {
                $em->persist($color);
                $em->flush();
                
                return $this->redirect($request->headers->get('referer'));
            }
        }

        return $this->render('TshirtSiteBundle:Color:add.html.twig', array('color' => $color, 'form' => $form->createView()));
    }
}
?>
