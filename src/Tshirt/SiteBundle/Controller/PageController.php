<?php
// src/Tshirt/SiteBundle/Controller/PageController.php

/**
 * 
 */

namespace Tshirt\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
    
    public function searchAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $request = new Request();
        $request = $this->getRequest()->query->get('query');
        
        $design = $em->getRepository('TshirtSiteBundle:Design')->findOneByName($request);
        
        if(!$design)
            return $this->render('TshirtSiteBundle:Search:error.html.twig', array('query' => $request, 'title' => "Search Error"));
        
        return $this->render('TshirtSiteBundle:Design:show.html.twig', array('design' => $design));
    }
}
?>
