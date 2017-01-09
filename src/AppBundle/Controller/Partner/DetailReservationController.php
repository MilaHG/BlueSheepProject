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
		
		//**preparation du mail de contact :
		
		$formBuilder = $this->createFormBuilder();
		//ici on ne fait pas de form type car on n'a pas de lien avec la base de données, donc pas de mapping
		
		$formBuilder
			->add(
				'name',
				TextType::class,
				[
				  'label'=>'Nom',
				  'constraints' => new NotBlank
				]
			)
			->add(
				'email',
				EmailType::class,
				[
				  'label'=>'Nom',
				  'constraints' =>
				  [
					new NotBlank(),
					new Email(),
				  ]
				]
			)
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
		
		if($this->getUser()){
			$form->get('name')->setData($this->getUser()->getFullName());
			$form->get('email')->setData($this->getUser()->getEmail());
		}
		
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
				
				$mailContent = "<h3>Blue-Sheep : message de ${data['name']} (${data['email']})" . '<p><b>' . $data['subject'] 
					. '</b></p>' . '<p>' . nl2br($data['body']) . '</p>'
				;
				
				$mail
					->setSubject('Blue-sheep : Message from our partner about your reservation ')
					->setFrom($this->getParameter('contact_email'))
					->setTo($this->getParameter('contact_email'))
					->setBody($mailContent)
					->setReplyTo($data['email'])
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
//			  'user'		=>$user,
//			  'form' => $form->createView(),
			]
		);
	}	
}
