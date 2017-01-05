<?php

namespace AppBundle\Controller\Partner;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Activity;


/**
 * ActivityController
 * 
 * @Route("/activity")
 */
class activityController extends Controller {

	/**
	 * @Route("/list")
	 */
	public function listAction() {
		
		//get the id of the current user
		$user = $this->container->get('security.token_storage')->getToken()->getUser()->getId();
		
		$em = $this->getDoctrine()->getManager();
		$activities=$em->getRepository('AppBundle:Activity')->findAllByPartner($user);
			
		//return all the data of the activities and the category related
		return $this->render('Partner/activity/list.html.twig', array(
			'activities'=>$activities,
		));
	}

	/**
	 * 
	 * @param $id
	 * @Route("/view/{id}")
	 */
	public function viewAction($id) {
		
		$em= $this->getDoctrine()->getManager();
		$activity = $em->find('AppBundle:Activity', $id);
		
		if (is_null($id)){
			throw $this->createNotFoundException();
		}
		
		$photos = $em->getRepository('AppBundle:Photo')->findByActivity($id);
		$comments = $em->getRepository('AppBundle:Comment')->findByActivity($id);
//		$nbTotalProduct=$em->getRepository('AppBundle:Product')->findNbProductByActivity($id);
//		$nbCurrentProduct=$em->getRepository('AppBundle:Product')->findNbProductByActivity($id,TRUE);
		
		return $this->render('Partner\activity\view.html.twig', 
			[
			  'activity'			=>$activity,
			  'photos'			=>$photos,
			  'comments'		=>$comments,
//			  'nbTotalProduct'		=>$nbTotalProduct,
//			  'nbCurrentProduct'	=>$nbCurrentProduct,
			]
		);
	}
	
	/**
	 * @Route("/edit/{id}", defaults={"id":null})
	 * @param Request $request
	 */
	public function editAction(Request $request, $id) {
		
		$em = $this->getDoctrine()->getManager();
		
		if (is_null($id)){
			$new=true;
			$activity=new Activity();
			$activity->setPartner($this->getUser());
		}
		else{
			$new=false;
			$activity=$em->find('AppBundle:Activity',$id);
			
			if(is_null($activity)){
				return $this->redirectToRoute('app_partner_activity_list');
			}
		}
		
		$activity = new Activity;
		$form= $this->createForm(ActivityType::class, $activity);
		
		$form->handleRequest($request);
		
		if($form->isSubmitted()){
			if($form->isValid()){
				
				$em->persist($activity);
				$em->flush();
				
				if($new){
					$message="Article enregistré";
				}
				else{
					$message="Modification réussie";
				}
				
				$this->addFlash('success','Your activity has been registred');
				
			//**********************vérifier cette route de redirection ci dessous vers edition de produit
				return $this->redirectToRoute();
			}
			else{
				$this->addFlash('error','Error : Your activity couldn\'t be registred');
			}
		}
		
		return $this->render(
			'Partner/activity/edit.html.twig',
			[
			  'form'	=> $form->createView(),
			  'activity'	=>$activity,
			  'new'=>$new,
			]
		);
	}

	/**
	 * @Route("delete/{id}")
	 */
	public function deleteAction() {
		
		$em = $this->getDoctrine()->getManager();
		
		$activity=$em->find('AppBundle:Activity', $id);
		if (is_null($activity)){
			$this->addFlash('error', 'This activity doesn\'t exist');
			return $this->redirectToRoute('app_partner_activity_list');
		}
		
		$em->remove($activity);
		$em->flush();
		
		$this->addFlash('success', 'Your activity was successfully deleted');
		return $this->redirectToRoute('app_partner_activity_list');
	}
	
}
