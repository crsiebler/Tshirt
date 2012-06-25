<?php
// src/Tshirt/SiteBundle/Controller/CategoryController.php

namespace Tshirt\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tshirt\SiteBundle\Entity\Category;
use Tshirt\SiteBundle\Form\CategoryType;

/**
 * 
 */
class CategoryController extends Controller
{
    /**
     * This function displays the form to add Categories and persists the request into the database.
     * 
     * @return html.twig
     */
    public function addAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        $category = new Category();
        
        $request = $this->getRequest();
        $form = $this->createForm(new CategoryType, $category);
        
        if($request->getMethod() == "POST")
        {
            $form->bindRequest($request);
            
            if($form->isValid())
            {
                $em->persist($category);
                $em->flush();
                
                return $this->redirect($request->headers->get('referer'));
            }
        }

        return $this->render('TshirtSiteBundle:Category:add.html.twig', array('category' => $category, 'form' => $form->createView()));
    }
}
?>
