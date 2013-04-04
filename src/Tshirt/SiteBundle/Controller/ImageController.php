<?php
// src/Tshirt/SiteBundle/Controller/ColorController.php

namespace Tshirt\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tshirt\SiteBundle\Entity\Image;
use Tshirt\SiteBundle\Form\ImageType;

/**
 * 
 */
class ImageController extends Controller
{
    /**
     * This function displays the form for an image upload and persists the request
     * to the database.
     * 
     * @return html.twig
     */
    public function addDesignPhotoAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $design = $this->getDesign($id);
        $image = new Image();
        $title = "Add Product Image";
        
        $request = $this->getRequest();
        $form = $this->createForm(new ImageType(), $image);
        
        if($request->getMethod() == "POST")
        {
            $form->bindRequest($request);
            
            if($form->isValid())
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
        
        return $this->render('TshirtSiteBundle:Image:add.html.twig', array('design' => $design, 'form' => $form->createView(), 'title' => $title));
    }
    
    /**
     * This function displays the form for an image upload and persists the request
     * to the database.
     * 
     * @return html.twig
     */
    public function addCustomerPhotoAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $design = $this->getDesign($id);
        $image = new Image();
        $title = "Add a Photo";
        
        $request = $this->getRequest();
        $form = $this->createForm(new ImageType(), $image);
        
        if($request->getMethod() == "POST")
        {
            $form->bindRequest($request);
            
            if($form->isValid())
            {
                $fileName = md5(time()).".".$image->getUploadedFile()->guessExtension();
                $image->getUploadedFile()->move($image->getUploadDir(), $fileName);
                $image->setPath($fileName);
                $image->setIsProductImage(false);
                $design->addImage($image);
                
                $em->persist($design);
                $em->flush();
                
                return $this->redirect($request->headers->get('referer'));
            }
        }
        
        return $this->render('TshirtSiteBundle:Image:add.html.twig', array('design' => $design, 'form' => $form->createView(), 'title' => $title));
    }
    
    /**
     * This function displays the customer uploaded images to a photo gallery.
     * 
     * @param integer $id
     * @return html.twig 
     */
    public function showGalleryAction($id)
    {
        $design = $this->getDesign($id);
        $images = $design->getImages();
        $customerImages = null;
        
        foreach($images as $image)
        {
            if(0 == $image->getIsProductImage())
                $customerImages[] = $image;
        }
        
        return $this->render('TshirtSiteBundle:Image:gallery.html.twig', array('images' => $customerImages, 'title' => "Customer Photos"));
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
