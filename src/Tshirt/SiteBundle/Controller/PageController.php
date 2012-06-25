<?php
// src/Tshirt/SiteBundle/Controller/PageController.php

/**
 * 
 */

namespace Tshirt\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    /**
     * This function displays the homepage of the Tshirt site and includes a javascript
     * carousel to display all the design products.
     * 
     * @return html.twig
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $designs = $em->getRepository('TshirtSiteBundle:Design')->findAll();
        
        return $this->render('TshirtSiteBundle:Page:index.html.twig', array('designs' => $designs));
    }
}
?>
