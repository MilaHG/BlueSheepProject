<?php

namespace AppBundle\Controller\Partner;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Activity;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductAttribute;
use AppBundle\Form\ProductAttributeType;
use AppBundle\Form\ProductType;

/**
 * ProductController
 * 
 * @Route("/product")
 */
class ProductController extends Controller{
	
	/**
	 * 
	 * @param $id "id of the activity concerned" 
	 * @Route("/list/{id}")
	 */
	public function listAction(Request $request, $id){
		//get the id of the current user
		$user = $this->container->get('security.token_storage')->getToken()->getUser()->getId();
		$em = $this->getDoctrine()->getManager();
		
		$activity=$em->getRepository('AppBundle:Activity')->find($id);
		
		if (is_null($activity)){
			$this->addFlash('error', 'This activity doesn\'t exist');
			return $this->redirectToRoute('app_partner_activity_list');
		}
		
		//the partner can only access his data, or he is rederected to his list
		if ($this->getUser()!==$activity->getPartner()){
			$this->addFlash('error','Error : You don\'t have the right over this activity');
			return $this->redirectToRoute('app_partner_activity_list');
		}
		
		$products=$em->getRepository('AppBundle:Product')->findByActivity($activity);
		
		//************vérifier que l'activité existe et que le bon partenaire regarde son activité
		
		$formsViews=[];
		$dump_request=0;
		
		foreach ($products as $product){
			
			//initiating this virtual property wich include the attributes extra fees
			//$product->setTotalPrice();
			
			$attribut=new ProductAttribute;
			$attribut->setProduct($product);
			
			//create one product-attribute form for each product, all stocked in an array :
			$form_att_u = $this->createForm(ProductAttributeType::class, $attribut);
			
			$formsViews[$product->getId()]=$form_att_u->createView();	
				
			$form_att_u->handleRequest($request);
			
			$productSelected=$form_att_u->getViewData()->getProduct();
			
			$dump_request=$form_att_u;
			$attribut->setProduct($productSelected);
			if($form_att_u->isSubmitted()){
				if($form_att_u->isValid()){

					//On récupère la donnée du produit qu'on a fixé sur le formulaire ci dessus avec la méthode setProduct
					
					
					$attribut->setProduct($productSelected);
//					$dump_request=$productSelected;
					$em->persist($attribut);
					$em->flush();

					$this->addFlash('success', 'Attribute added');
					return $this->redirect( 
						$this->generateUrl(
							'app_partner_product_list',
							[
							  'id' => $activity->getId(),
							]
						) 
					);
				}
				else{
					$this->addFlash('error', 'The attribute couldn\'t be registered');
				}
			}
		}
		
		//return all the data of the activities and the category related
		return $this->render('Partner/Product/list.html.twig', array(
			'products'	=>$products,
			'activity'	=>$activity,
			'forms'	=>$formsViews,
			'request'	=>$dump_request,
		));
	}

	/**
	 * @param $id "id of the product concerned" 
	 * @Route("/delete/{id}")
	 */
	public function deleteAction($id){
		
		$em = $this->getDoctrine()->getManager();
		
		$product=$em->find('AppBundle:Product', $id);
		if (is_null($product)){
			$this->addFlash('error', 'This product doesn\'t exist');
			return $this->redirectToRoute('app_partner_product_list');
		}
		
		$activity=$product->getActivity();
		
		//the partner can only access his data, or he is rederected to his list
		if ($this->getUser()!==$activity->getPartner()){
			$this->addFlash('error','Error : You don\'t have the right over this activity');
			return $this->redirectToRoute('app_partner_activity_list');
		}
		
		$em->remove($product);
		$em->flush();
		
		$this->addFlash('success', 'Your product was successfully deleted');
		return $this->redirect( $this->generateUrl('app_partner_product_list', array('id' => $activity->getId())) );
	}

	/**
	 * @param $id_a "id of the activity concerned" 
	 * @param $id_a "id of the product concerned" 
	 * @Route("/edit/{id_a}/{id_p}")
	 */
	public function editAction(Request $request,$id_a, $id_p = null ){
		
		$em = $this->getDoctrine()->getManager();
		
		$activity=$em->find('AppBundle:Activity',$id_a);
			
		if(is_null($activity)){
			$this->addFlash('error', 'This activity doesn\'t exist');
			return $this->redirectToRoute('app_partner_activity_list');
		}
		
		//the partner can only access his data, or he is rederected to his list
		if ($this->getUser()!==$activity->getPartner()){
			$this->addFlash('error','Error : You don\'t have the right over this activity');
			return $this->redirectToRoute('app_partner_activity_list');
		}
		
		if (is_null($id_p)){
			$new=true;
			$product=new Product();
			$product->setActivity($activity);
		}
		
		else{
			$new=false;
			$product=$em->find('AppBundle:Product',$id_p);
			
			if(is_null($product)){
				$this->addFlash('error', 'This product doesn\'t exist');
				return $this->redirectToRoute('app_partner_product_list', array('id' => $id_a));
			}
		}
		
		$form= $this->createForm(ProductType::class, $product);
		
		$form->handleRequest($request);
		
		if($form->isSubmitted()){
			if($form->isValid()){
				$product->setActivity($activity);
				$em->persist($product);
				$em->flush();
								
				$this->addFlash('success','Data saved');
				
			//**********************vérifier cette route de redirection ci dessous vers edition de produit
				return $this->redirectToRoute('app_partner_product_list', array('id' => $id_a));
			}
			else{
				$this->addFlash('error','Error : Your product couldn\'t be registred');
			}
		}
		
		return $this->render(
			'Partner/Product/edit.html.twig',
			[
			  'form'	=> $form->createView(),
			  'product'	=>$product,
			  'new'	=>$new,
			]
		);
	}

	
	/**
	 * @Route("deleteAttribut/{id}",name="app_partner_product_deleteAttribut")
	 * @param $id  "id of the attribute concerned" 
	 */
	public function deleteAttributAction($id){
		
		$em = $this->getDoctrine()->getManager();
		
		$attribut=$em->find('AppBundle:ProductAttribute', $id);
		if (is_null($attribut)){
			$this->addFlash('error', 'This attribut doesn\'t exist');
			return $this->redirectToRoute('app_partner_product_list');
		}
		
		$activity=$attribut->getProduct()->getActivity();
		
		//the partner can only access his data, or he is rederected to his list
		if ($this->getUser()!==$activity->getPartner()){
			$this->addFlash('error','Error : You don\'t have the right over this activity');
			return $this->redirectToRoute('app_partner_activity_list');
		}
		
		$em->remove($attribut);
		$em->flush();
		
		$this->addFlash('success', 'Your attribut was successfully deleted');
		return $this->redirect( $this->generateUrl('app_partner_product_list', array('id' => $activity->getId())) );
	}
}
