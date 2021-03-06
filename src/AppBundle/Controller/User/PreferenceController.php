<?php

namespace AppBundle\Controller\User;

use AppBundle\Entity\Hobby;
use AppBundle\Form\HobbyType;
use PDOException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class PreferenceController extends Controller
{
    /**
     * 
     * @Route("preference/list")
     */
    public function listAction(Request $request)
    {
        //getting user's ID
        $user = $this->getUser()->getId();
        
        //relation DB
        $em = $this->getDoctrine()->getManager();

        if (is_null($user)) { //page 404 if user not in DB
            throw $this->createNotFoundException();
        }
        
        //access to the Preference Class repository (i.e. Hobby) and display them in the view
        $repository = $em->getRepository('AppBundle:Hobby');
        //request to DB => "SELECT * FROM..."
        $preferences = $repository->findByUser($user);
        
        $form = $this->createForm(HobbyType::class);
        $form->handleRequest($request);
        
        return $this->render(
            'AppBundle:User\Preference:list.html.twig', 
            [
                'preferences'   => $preferences,
                'form'  =>  $form->createView(),
            ]
        );
    }
    
     /**
     * @param Request $request
     * @Route("preference/add")
     */
    public function addAction(Request $request)
    {
        //getting user's ID
        $user = $this->getUser()->getId();
        
        $em = $this->getDoctrine()->getManager();
        
        if (is_null($user)) { //page 404 if user not in DB
            throw $this->createNotFoundException();
        }

        $preference = new Hobby();

        $form = $this->createForm(HobbyType::class, $preference);
        $form->handleRequest($request);
        
        // if the form has been submitted
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $preference
                    ->setUser($this->getUser())
                ;
                
                try {
                    $em->persist($preference);
                    $em->flush();
                } catch (\Doctrine\DBAL\Exception\UniqueConstraintViolationException $exc) {
//                    die ('Oops !'. $exc->getMessage());
                    $this->addFlash('error', 'Vous avez déjà choisi cette categorie.');
                
                return $this->redirectToRoute('app_user_preference_list');
                }

                $em->persist($preference);
                $em->flush();
                
                $this->addFlash('success', 'Votre hobby a été ajouté à votre profil.');
                
                return $this->redirectToRoute('app_user_preference_list');
            } else {
                $this->addFlash('error', 'Les données soumises ne sont pas valides.');
            }
        }
//        $response = new Response();
//        return $response('test');

        return $this->render(
            'AppBundle:User\Preference:add.html.twig', array
            (
                
        ));
    }

    /**
     * @Route("preference/delete/{id}")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $preference = $em->find('AppBundle:Hobby', $id);
        
        if (is_null($preference)) { // if no hobby corresponding with the id requested : redirection to the preferences' list
            return $this->redirectToRoute('app_user_preference_list');
        }

        $em->remove($preference);
        $em->flush();
        
        $this->addFlash('success', 'Votre sélection a bien été supprimée.');
        
        return $this->redirectToRoute('app_user_preference_list');
//return $this->render('AppBundle:User\Preference:delete.html.twig', array(
            // ...
//        ));
    }

    // Action set aside for now 
       /**
     * @Route("preference/edit")
     */
    public function editAction()
    {
      return $this->render(
            'AppBundle:User\Preference:edit.html.twig', array
            (
                //...
        ));
    }

//        $em = $this->getDoctrine()->getManager();
    
//         $repository = $em->getRepository('AppBundle:Hobby');
        //request to DB => "SELECT * FROM..."
//        $preferences = $repository->findByUser($user);
        
//        if (is_null($id)) //create preference
//        {
//            $new = true;
//            $preference = new Hobby();
//            $preference->setHobby($this->getUser());//adding a category for the connected user
//        } else { // edit preference
//            $new = false;
//            $preference = $em->find('AppBundle:Hobby', $id);
//            
//            if (is_null($preference)) { // if the requested id has no correspondance in DB : redirection on preferences' list
//                return $this->redirectToRoute('app_user_preference_list');
//            }
//        }
//    
//        $form = $this->createForm(HobbyType::class, $preference);
//        $form->handleRequest($request);
//        
//        // if the form has been submitted
//        if ($form->isSubmitted()) {
//            if ($form->isValid()) {
//                $em->persist($preference);
//                $em->flush();
//                
//                $msg = ($new)
//                    ? "Your hobby has been added to your profile."
//                    : "Changes made to your hobby have been saved."
//                ;
//                
//                $this->addFlash('success', $msg);
//                
//                return $this->redirectToRoute('app_user_preference_list');
//            } else {
//                $this->addFlash('error', 'The submitted data is not valid.');
//            }
//        }
//
//        return $this->render(
//            'AppBundle:User\Preference:edit.html.twig', array
//            (
//                'new'   =>  $new,
//                'form'  =>  $form->createView(),
//        ));
//    }

}
