<?php

namespace AppBundle\Controller\Partner;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\DetailReservation;
use AppBundle\Entity\User;
/**
 * 
 * @Route("/reservations")
 */
class DetailReservationController extends Controller {

	/**
	 * DetailReservationController
	 * @Route("/list")
	 */
	public function listAction() {
		//get the id of the current user
		$user = $this->container->get('security.token_storage')->getToken()->getUser()->getId();
		$em=$this->getDoctrine()->getManager();
		$reservations = $em->getRepository('AppBundle:User')->findAllByPartner($user);
		
		
		
		return $this->render('Partner/DetailReservation/list.html.twig', array(
			'reservation' => $reservations,
		));
	}

}
