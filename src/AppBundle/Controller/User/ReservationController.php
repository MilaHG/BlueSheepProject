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
		
		$user = $this->getUser();
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
	 * @param $id
	 * @Route("/view/{id}")
	 */
	public function viewAction($id) {
		
		$user = $this->getUser();
		$em=$this->getDoctrine()->getManager();
		
		$reservation_detail=$em->getRepository('AppBundle:DetailReservation')->find($id);
		
		if (is_null($reservation_detail)){
			throw $this->createNotFoundException();
		}
		
		
		if($reservation_detail->getReservation()->getUser()->getId()!==$user->getId()){
			return $this->redirectToRoute('app_user_reservation_list');
		}

		return $this->render(
			'User/Reservation/view.html.twig',
			[
			  'd_reservation'	=>$reservation_detail,
			]
		);
	}
}
