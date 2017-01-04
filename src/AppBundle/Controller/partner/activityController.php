<?php

namespace AppBundle\Controller\Partner;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;
use AppBundle\Entity\Activity;

class activityController extends Controller {

	/**
	 * @Route("/list")
	 */
	public function listAction() {
		
		//get the id of the current user
		$user = $this->container->get('security.context')->getToken()->getUser();
		
		$em = $this->getDoctrine()->getManager();
		$activities=$em->getRepository('AppBundle:Activity')->findAllByPartner($user);
			
		//return all the data of the activities and the category related
		return $this->render('AppBundle:partner\activity:list.html.twig', array(
			'activities'=>$activities,
		));
	}

	/**
	 * 
	 * @param Request $request
	 * @param $id
	 * @Route("/activity/{id}")
	 */
	public function viewAction( $id) {
		$em->getDoctrine()->getManager();
		$activity = $em->find('AppBundle:Activity', $id);
		
		if (is_null($article)){
			throw $this->createNotFoundException();
		}
		
		$photos = $em->getRepository('AppBundle:Photo')->findByActivity($id);
		$comments = $em->getRepository('AppBundle:Comment')->findByActivity($id);
		$nbTotalProduct=$em->getRepository('AppBundle:Product')->findNbProductByActivity($id);
		$nbCurrentProduct=$em->getRepository('AppBundle:Product')->findNbProductByActivity($id,TRUE);
		
		return $this->render('AppBundle:partner\activity:view.html.twig', 
			[
			  'activity'			=>$activity,
			  'photos'			=>$photos,
			  'comments'		=>$comments,
			  'nbTotalProduct'		=>$nbTotalProduct,
			  'nbCurrentProduct'	=>$nbCurrentProduct,
			]
		);
	}
	
	/**
	 * @Route("/new")
	 */
	public function newAction() {
		return $this->render('AppBundle:partner\activity:new.html.twig', array(
			
		));
	}

	/**
	 * @Route("/delete")
	 */
	public function deleteAction() {
		return $this->render('AppBundle:partner\activity:delete.html.twig', array(
				// ...
		));
	}
	
	
	/**
	 * @Route("/delete")
	 */
	public function delelteAction() {
		return $this->render('AppBundle:partner\activity:delete.html.twig', array(
				// ...
		));
	}

}
