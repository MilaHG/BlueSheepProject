<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * @Route("activities/{id}")
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
     * @Route("product_detail/{id}")
     */
    public function detailAction($id, Request $request)
    {
        
        $em = $this->getDoctrine()->getManager();
        $activity = $em->find('AppBundle:Activity', $id);
        
        $activities = $em->getRepository('AppBundle:Activity')
                ->findBy(array(
                    'category' => $activity->getCategory()
                ));
        
        
    // handle user comment 
        $comment = new Comment();
        
        
        $form_comment = $this->createFormBuilder($comment)
                ->add('comment',
                TextareaType::class,
                        array(
                            'label' => 'Commentaire',
                            'required' =>FALSE,
                            'attr' => array(
                                'placeholder' => 'Laisser un commentaire '
                            )
                            
                        ))
                ->add('note',
                ChoiceType::class,
                        array(
                            'choices' =>array(
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                            ),
                            'label' => 'Note'
                        ))
                ->add('save',
                \Symfony\Component\Form\Extension\Core\Type\SubmitType::class,
                        array(
                            'label' => 'Laisser un commentaire'
                        ))
                ->getForm();
        
        $form_comment->handleRequest($request);
        
        if($form_comment->isSubmitted() && $form_comment->isValid()){
            
            $comment->setUser($this->getUser());
            $comment->setActivity($activity);
            $comment = $form_comment->getData();
            echo "User :  ".$this->getUser();
 

            
            $em->persist($comment);
            $em->flush();
            
        }
        

        return $this->render('AppBundle:Product:detail.html.twig', array(
            
            'activity' => $activity,
            'activities' => $activities,
            'form' => $form_comment->createView()
            // ...
        ));
    }

}
