<?php

namespace AppBundle\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Reservation;

/**
 * Reservation controller
 * @Route("/reservation")
 */
class ReservationController extends Controller {

	/**
	 * @Route("/list")
	 */
	public function listAction() {
		
		$user = $this->container->get('security.token_storage')->getToken()->getUser()->getId();
		$em=$this->getDoctrine()->getManager();
		$reservations = $em->getRepository('AppBundle:Reservation')->findByUser($user);
		
		$totalAmount=0;
		foreach ($reservations as $reservation) {
			$reservation->getProduct()->setTotalPrice();
			$totalAmount=$reservation->getTotalAmount();
		}
		
		return $this->render(
			'User/Reservation/list.html.twig',
			[
			  'reservations'	=>$reservations,
			  'user'		=>$user,
			  'totalAmount'	=>$totalAmount
			]
		);
	}

	/**
	 * @Route("/view/{id}")
	 */
	public function viewAction() {
		
		
		return $this->render(
			'AppBundle:Reservation:view.html.twig',
			[
			  
			]
		);
	}

}
