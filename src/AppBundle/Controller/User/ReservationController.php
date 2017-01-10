<?php

namespace AppBundle\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Reservation;
use AppBundle\Entity\DetailReservation;

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
			foreach ($reservation->getDetailsReservations() as $d_reservation) {
				$d_reservation->setTotalPrice();
				$totalAmount=$reservation->getTotalAmount();
			}
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
	public function viewAction($id) {
		
		$user = $this->container->get('security.token_storage')->getToken()->getUser()->getId();
		$em=$this->getDoctrine()->getManager();
		
		$reservation_detail=$em->getRepository('AppBundle:DetailReservation')->findByUserAndId($id,$user);
		
		return $this->render(
			'User/Reservation/view.html.twig',
			[
			  'reservations'	=>$reservation_detail,
			]
		);
	}
}
