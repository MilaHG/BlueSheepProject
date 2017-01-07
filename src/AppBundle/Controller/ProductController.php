<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductController extends Controller
{
    /**
     * @Route("products/{id}")
     */
    public function listAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();
        
        return $this->render('AppBundle:Product:list.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/category")
     */
    public function categoryAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('AppBundle:Category')->findAll();
        
        return $this->render('AppBundle:Product:category.html.twig', array(
            
            'categories' => $categories
            // ...
        ));
    }

    /**
     * @Route("product")
     */
    public function detailAction()
    {
        return $this->render('AppBundle:Product:detail.html.twig', array(
            // ...
        ));
    }

}