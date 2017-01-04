<?php

namespace AppBundle\Controller\User;

use AppBundle\Entity\Hobby;
use AppBundle\Form\HobbyType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PreferenceController extends Controller
{
    /**
     * @Route("preference/list/{id}, requirements={"id":"\d+"})
     */
    public function listAction($id)
    {
        //relation DB
        $em = $this->getDoctrine()->getManager();
        //access to the Preference Class repository (i.e. Hobby)
        $repository = $em->getRepository('AppBundle:Hobby');
        //request to DB => "SELECT * FROM..."
        $preferences = $repository->findAll();
        
        return $this->render('AppBundle:User\Preference:list.html.twig', array(
            'preferences'   => $preferences,
        ));
    }

    /**
     * @Route("preference/edit/{id}", defaults={"id":null})
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        if (is_null($id)) //create preference
        {
            $new = true;
            $preference = new Hobby();
            $preference->setCategory($this->getUser());//adding a category for the connected user
        } else { // edit preference
            $new = false;
            $preference = $em->find('AppBundle:Preference', $id);
            
            if (is_null($preference)) { // if the requested id has no correspondance in DB : redirection on preferences' list
                return $this->redirectToRoute('app_user_preference_list');
            }
        }
    
        $form = $this->createForm(HobbyType::class, $preference);
        $form->handleRequest($request);
        
        // if the form has been submitted
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em->persist($preference);
                $em->flush();
                
                $msg = ($new)
                    ? "Your hobby has been added to your profile."
                    : "Changes made to your hobby have been saved."
                ;
                
                $this->addFlash('success', $msg);
                
                return $this->redirectToRoute('app_user_preference_list');
            } else {
                $this->addFlash('error', 'The submitted data is not valid.');
            }
        }

        return $this->render(
            'AppBundle:User\Preference:edit.html.twig', array
            (
                'new'   =>  $new,
                'form'  =>  $form->createView(),
        ));
    }

    /**
     * @Route("preference/delete/{$id}")
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
        
        $this->addFlash('success', 'The selected hobby has been successfully deleted.');
        
        return $this->redirectToRoute('app_user_preference_list');
//return $this->render('AppBundle:User\Preference:delete.html.twig', array(
            // ...
//        ));
    }

    // Action set aside for now as adding a preference is managed with the editAction
    /**
     * @Route("preference/add")
     */
//    public function addAction()
//    {
//        return $this->render('AppBundle:User\Preference:add.html.twig', array(
//            // ...
//        ));
//    }

}
