<?php

namespace AppBundle\Controller\Partner;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\DetailReservation;
use AppBundle\Entity\Reservation;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * DetailReservationController
 * 
 * @Route("/reservations")
 */
class DetailReservationController extends Controller {

	/**
	 * 
	 * @Route("/list", name="app_partner_reservations_list")
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
	 * @param Request $request
	 * @Route("/view/{id}", name="app_partner_reservations_view")
	 */
	public function contactAction(Request $request, $id){
		$em=$this->getDoctrine()->getManager();
		$d_reservation = $em->find('AppBundle:DetailReservation',$id);
		
		if (is_null($d_reservation)){
			throw $this->createNotFoundException();
		}
		
		$d_reservation->getProduct()->setTotalPrice();
		$productAtt=$d_reservation->getProduct_attribute();
		$reservation = $d_reservation->getReservation();
		
		//the partner can only access his data, or he is rederected to his list
		if ($this->getUser()!==$d_reservation->getProduct()->getActivity()->getPartner()){
			$this->addFlash('error','Error : You don\'t have the right over this activity');
			return $this->redirectToRoute('app_partner_reservations_list');
		}
		//**preparation du mail de contact :
		
		$formBuilder = $this->createFormBuilder();
		//ici on ne fait pas de form type car on n'a pas de lien avec la base de données, donc pas de mapping
		
		$formBuilder
			->add(
				'subject',
				TextType::class,
				[
				  'label'=>'Sujet',
				  'constraints' => new NotBlank
				]
			)
			->add(
				'body',
				TextareaType::class,
				[
				  'label'=>'Votre message',
				  'constraints' => new NotBlank
				]
			)
		;
		
		$form = $formBuilder->getForm();
		
//		if($this->getUser()){
//			$form->get('email')->setData($this->getUser()->getEmail());
//		}
				
		$form->handleRequest($request);
		if ($form->isSubmitted()){
			if($form->isValid()){
				$data = $form->getData();
							
				/** \Swift_Mailer */
				$mailer = $this->get('mailer');
				/* les config du mailer doivent etre config/ecrite dans parametres.ymail
				 * Attention : on ne versionne pas les paramètres, mais on rajoute des infos dans parametres.ymail.dist
				 */
				
				$mail = $mailer->createMessage();
				
				$mailContent = "<h3>Blue-Sheep : message of the company " .$this->getUser()->getCompany(). '</h3>' . '<p>' . nl2br($data['body']) . '</p>'
				;
				
				$mail
					->setSubject('Blue-sheep : New message from our partner about your reservation '. $reservation->getId())
					->setFrom($this->getParameter('contact_email'))
					->setTo($user->getEmail())
					->setBody($mailContent)
					->setReplyTo($this->getUser()->getEmail())
				;
				
				$mailer->send($mail);
				$this->addFlash('success', 'email sent');
			}
			else{
				$this->addFlash('error', 'your email couldn\'t be sent' );
			}
		}
		
		return $this->render(
			'Partner/DetailReservation/view.html.twig', 
			[
			  'd_reservation'	=>$d_reservation,
			  'reservation'	=>$reservation,
			  'productAtt'	=>$productAtt,
			  'form' => $form->createView(),
			]
		);
	}	
}
