<?php
// src/Tshirt/SiteBundle/Controller/DesignController.php

namespace Tshirt\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tshirt\SiteBundle\Entity\Design;
use Tshirt\SiteBundle\Entity\Image;
use Tshirt\SiteBundle\Form\DesignType;
use Tshirt\SiteBundle\Form\ImageType;

/**
 * 
 */
class DesignController extends Controller
{
    /**
     * This function displays the form to add a Design and persist it to the database.
     * 
     * @return html.twig
     */
    public function addAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $design = new Design();
        $image = new Image();
        
        $request = $this->getRequest();
        $designForm = $this->createForm(new DesignType(), $design);
        $imageForm = $this->createForm(new ImageType(), $image);
        
        if($request->getMethod() == "POST")
        {
            $designForm->bindRequest($request);
            $imageForm->bindRequest($request);
            
            if($designForm->isValid() && $imageForm->isValid())
            {
                $fileName = md5(time()).".".$image->getUploadedFile()->guessExtension();
                $image->getUploadedFile()->move($image->getUploadDir(), $fileName);
                $image->setPath($fileName);
                $image->setIsProductImage(true);
                $design->addImage($image);
                
                $em->persist($design);
                $em->flush();
                
                return $this->redirect($request->headers->get('referer'));
            }
        }
        
        return $this->render('TshirtSiteBundle:Design:add.html.twig', array('design' => $design, 'designForm' => $designForm->createView(), 'imageForm' => $imageForm->createView()));
    }
    
    /**
     * This function updates the design entity information. The id of the design to be
     * updated is passed in as a parameter through the url routing.
     * 
     * @param integer $id Primary key of the Design Entity.
     * @return html.twig 
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $design = $this->getDesign($id);
        
        $request = $this->getRequest();
        
        $form = $this->createForm(new DesignType(), $design);
        
        if($request->getMethod() == "POST")
        {
            $form->bindRequest($request);
            
            if($form->isValid())
            {
                $em->persist($design);
                $em->flush();
                
                return $this->redirect($request->headers->get('referer'));
            }
        }
        
        return $this->render('TshirtSiteBundle:Design:update.html.twig', array('design' => $design, 'form' => $form->createView()));
    }
    
    /**
     * This function displays a single design's information.
     * 
     * @param integer $id Primary key of the design entity.
     * @return html.twig 
     */
    public function showAction($id)
    {
        $design = $this->getDesign($id);
        
        return $this->render('TshirtSiteBundle:Design:show.html.twig', array('design' => $design));
    }
    
    /**
     * This function displays a gallery of the last 6 design entities created.
     * 
     * @return html.twig
     * @throws NotFoundException
     */
    public function showNewAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $designs = $em->getRepository('TshirtSiteBundle:Design')->getNewestDesigns();
        
        if(!$designs)
            throw $this->createNotFoundException('Unable to find Designs.');
        
        return $this->render('TshirtSiteBundle:Design:gallery.html.twig', array('designs' => $designs, 'title' => "New Products"));
    }
    
    /**
     * This function displays a gallery of all the designs with the isPopular set
     * to true.
     * 
     * @return html.twig
     * @throws NotFoundException
     */
    public function showPopularAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $designs = $em->getRepository('TshirtSiteBundle:Design')->findByisPopular(1);
        
        if(!$designs)
            throw $this->createNotFoundException('Unable to find Designs.');
        
        return $this->render('TshirtSiteBundle:Design:gallery.html.twig', array('designs' => $designs, 'title' => "Popular Products"));
    }
    
    /**
     * This function displays a gallery of all the designs within the database.
     * 
     * @return html.twig
     * @throws NotFoundException 
     */
    public function showAllAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $designs = $em->getRepository('TshirtSiteBundle:Design')->findAll();
        
        if(!$designs)
            throw $this->createNotFoundException('Unable to find Designs.');
        
        return $this->render('TshirtSiteBundle:Design:gallery.html.twig', array('designs' => $designs, 'title' => "All Products"));
    }    
    
    /**
     * This function retrieves the design entity that matches the id set in the parameter.
     * 
     * @param integer $id Primary key of the design entity
     * @return Design
     * @throws NotFoundException
     */
    protected function getDesign($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $design = $em->getRepository('TshirtSiteBundle:Design')->find($id);
        
        if(!$design)
            throw $this->createNotFoundException('Unable to find Design.');
        
        return $design;
    }
}
?>
