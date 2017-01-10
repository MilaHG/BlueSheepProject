<?php

namespace AppBundle\Controller\Partner;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Activity;
use AppBundle\Form\ActivityType;
use AppBundle\Entity\Comment;


/**
 * ActivityController
 * 
 * @Route("/activity")
 */
class ActivityController extends Controller {

	/**
	 * @Route("/list")
	 */
	public function listAction() {
		
		//get the id of the current user
		$user = $this->container->get('security.token_storage')->getToken()->getUser()->getId();
		
		$em = $this->getDoctrine()->getManager();
		$activities=$em->getRepository('AppBundle:Activity')->findAllByPartner($user);
			
		//return all the data of the activities and the category related
		return $this->render('Partner/Activity/list.html.twig', array(
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
		$averageNote=$activity->getAverageNote();
		return $this->render('Partner\Activity\view.html.twig', 
			[
			  'activity'			=>$activity,
			  'photos'			=>$photos,
			  'comments'		=>$comments,
			  'average_note'		=>$averageNote,
//			  'nbTotalProduct'		=>$nbTotalProduct,
//			  'nbCurrentProduct'	=>$nbCurrentProduct,
			]
		);
	}
	
	/**
	 * @Route("/edit/{id}", defaults={"id":null})
	 * @param $id
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
		
		$form= $this->createForm(ActivityType::class, $activity);
		
		$form->handleRequest($request);

		if($form->isSubmitted()){
			
			if($form->isValid()){
				
				//foreach ($activity->getPhotos() as $photo) {
					//if (!is_null($photo->getName())){
				//		$photo->setActivity($activity);
					//}
				//}

				$em->persist($activity);
				$em->flush();
				
				if($new){
					$message="Activity saved";
				}
				else{
					$message="Activity's modifications saved";
				}
				
				$this->addFlash('success',$message);
				
			//**********************vérifier cette route de redirection ci dessous vers edition de produit
				return $this->redirectToRoute('app_partner_activity_list');
			}
			else{
				$this->addFlash('error','Error : Your activity couldn\'t be registred');
			}
		}
		
		return $this->render(
			'Partner/Activity/edit.html.twig',
			[
			  'form'	=> $form->createView(),
			  'activity'	=>$activity,
			  'new'	=>$new,
			]
		);
	}

	/**
	 * @Route("/delete/{id}")
	 * @param $id
	 */
	public function deleteAction($id) {
		
		$em = $this->getDoctrine()->getManager();
		
		$activity=$em->find('AppBundle:Activity', $id);
		if (is_null($activity)){
			$this->addFlash('error', 'This activity doesn\'t exist');
			return $this->redirectToRoute('app_partner_activity_list');
		}
		$photos=$activity->getPhotos();
		if(!is_null($photos)){
			foreach ($photos as $photo) {
				$em->remove($photo);
			}
		}
		$em->remove($activity);
		$em->flush();
		
		$this->addFlash('success', 'Your activity was successfully deleted');
		return $this->redirectToRoute('app_partner_activity_list');
	}
	
}
