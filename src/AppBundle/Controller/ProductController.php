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
         
        $activities = $em->getRepository('AppBundle:Activity')
                ->findBy(array(
                    'category' => $id
                ));

        return $this->render('AppBundle:Product:list.html.twig', array(
            
            'activities' => $activities,
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
     * @Route("product/{id}")
     */
    public function detailAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();
        $activity = $em->find('AppBundle:Activity', $id);
        
        $activities = $em->getRepository('AppBundle:Activity')
                ->findBy(array(
                    'category' => $activity->getCategory()
                ));
        
        return $this->render('AppBundle:Product:detail.html.twig', array(
            
            'activity' => $activity,
            'activities' => $activities
            // ...
        ));
    }

}
