<?php

namespace AppBundle\Controller\Partner;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\DetailReservation;
use AppBundle\Entity\Reservation;
use AppBundle\Entity\User;

/**
 * DetailReservationController
 * 
 * @Route("/reservations")
 */
class DetailReservationController extends Controller {

	/**
	 * 
	 * @Route("/list")
	 */
	public function listAction() {
		//get the id of the current user
		$user = $this->container->get('security.token_storage')->getToken()->getUser()->getId();
		$em=$this->getDoctrine()->getManager();
		$d_reservations = $em->getRepository('AppBundle:DetailReservation')->findAllByPartner($user);
		$current_total=0;
		
		foreach ($d_reservations as $d_reservation) {
			$current_total+=$d_reservation->getProduct()->setTotalPrice()->getTotalPrice() * $d_reservation->getQuantity() ;
		}
		
		return $this->render('Partner/DetailReservation/list.html.twig', array(
			'd_reservations'	=> $d_reservations,
			'totalAmount'	=> $current_total,
		));
	}
	
	
	/**
	 * @param $id id of the reservation Detail
	 * @Route("/view/{id}", name="app_partner_reservations_view")
	 */
	public function contactAction($id){
		$em=$this->getDoctrine()->getManager();
		$d_reservation = $em->find('AppBundle:DetailReservation',$id);
		
		if (is_null($d_reservation)){
			throw $this->createNotFoundException();
		}
		//$reservation = $em->getRepository('AppBundle:DetailReservation')->findByReservationDetails($d_reservation);
		$reservation = $d_reservation->getReservation();
//		$user=$reservation->getUser();
		
		
		return $this->render(
			'Partner/DetailReservation/view.html.twig', 
			[
			  'd_reservation'	=>$d_reservation,
			  'reservation'	=>$reservation,
//			  'user'		=>$user,
			]
		);
	}	
}
