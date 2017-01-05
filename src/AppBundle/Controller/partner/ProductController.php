<?php

namespace AppBundle\Controller\Partner;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Activity;
use AppBundle\Entity\Product;

/**
 * ProductController
 * 
 * @Route("/product")
 */
class ProductController extends Controller{
	
	/**
	 * @param $id "id of the activity concerned" 
	 * @Route("/list/{id}")
	 */
	public function listAction($id){
		//get the id of the current user
		$user = $this->container->get('security.token_storage')->getToken()->getUser()->getId();
		
		
		
		$em = $this->getDoctrine()->getManager();
		$activity=$em->getRepository('AppBundle:Activity')->find($id);
		
		//************vérifier que l'activité existe et que le bon partenaire regarde son activité
		
		$products=$em->getRepository('AppBundle:Product')->findByActivity($activity);
			
		//return all the data of the activities and the category related
		return $this->render('Partner/Product/list.html.twig', array(
			'products'	=>$products,
			'activity'	=>$activity,
		));
	}

	/**
	 * @param $id "id of the product concerned" 
	 * @Route("/delete/{id}")
	 */
	public function deleteAction(){
		
		$em = $this->getDoctrine()->getManager();
		
		$product=$em->find('AppBundle:Product', $id);
		if (is_null($product)){
			$this->addFlash('error', 'This product doesn\'t exist');
			return $this->redirectToRoute('app_partner_activity_list');
		}
		
		$activity=$product->getActivity();
		
		$em->remove($product);
		$em->flush();
		
		$this->addFlash('success', 'Your activity was successfully deleted');
		return $this->redirect( $this->generateUrl('app_partner_product_list', array('id' => $article->getId())) );
		
	}

	/**
	 * @param $id "id of the product concerned" 
	 * @Route("/edit/{id}")
	 */
	public function editAction(){
		
		return $this->render('AppBundle:Partner\Product:edit.html.twig', array(
		// ...
	));
	}

	/**
	 * @param $id "id of the product concerned" 
	 * @param Request $request
	 * @Route("/addAttribut/{id}")
	 */
	public function addAttributAction(Request $request){
		
		
		
		return $this->render('Partner/Product/add_attribut.html.twig', array(
		// ...
		));
	}

	/**
	 * @Route("deleteAttribut/{id}",name="app_partner_product_deleteAttribut")
	 * @param $id  "id of the attribute concerned" 
	 */
	public function deleteAttributAction(){
		
		$em = $this->getDoctrine()->getManager();
		
		$attribut=$em->find('AppBundle:ProductAttribute', $id);
		if (is_null($attribut)){
			$this->addFlash('error', 'This attribut doesn\'t exist');
			return $this->redirectToRoute('app_partner_activity_list');
		}
		
		$activity=$attribut->getProduct()->getActivity();
		
		$em->remove($attribut);
		$em->flush();
		
		$this->addFlash('success', 'Your attribut was successfully deleted');
		return $this->redirect( $this->generateUrl('app_partner_product_list', array('id' => $activity->getId())) );
	}

}
