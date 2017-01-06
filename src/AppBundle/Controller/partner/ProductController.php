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
	 * @param $id "id of the activity concerned" 
	 * @Route("/list/{id}")
	 */
	public function listAction(Request $request, $id){
		//get the id of the current user
		$user = $this->container->get('security.token_storage')->getToken()->getUser()->getId();
		$em = $this->getDoctrine()->getManager();
		
		$activity=$em->getRepository('AppBundle:Activity')->find($id);
		$products=$em->getRepository('AppBundle:Product')->findByActivity($activity);
		
		if (is_null($activity)){
			$this->addFlash('error', 'This activity doesn\'t exist');
			return $this->redirectToRoute('app_partner_activity_list');
		}
		
		//************vérifier que l'activité existe et que le bon partenaire regarde son activité
		
		foreach ($products as $product){
			$attribut=new ProductAttribute;
			$attribut->setProduct($product);
			$form_att_u = $this->createForm(ProductAttributeType::class, $attribut);
			$formsViews[$product->getId()]=$form_att_u->createView();	
				
			$form_att_u->handleRequest($request);

			if($form_att_u->isSubmitted()){
				if($form_att_u->isValid()){

					//$attribut->setProduct($product);
					$em->persist($attribut);
					$em->flush();

					$this->addFlash('success', 'Attribute added');
					return $this->redirect( $this->generateUrl('app_partner_product_list', array('id' => $product->getId())) );
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
			return $this->redirectToRoute('app_partner_product_list');
		}
		
		$product=$product->getActivity();
		
		$em->remove($product);
		$em->flush();
		
		$this->addFlash('success', 'Your product was successfully deleted');
		return $this->redirect( $this->generateUrl('app_partner_product_list', array('id' => $product->getId())) );
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
		
		$product=$attribut->getProduct()->getActivity();
		
		$em->remove($attribut);
		$em->flush();
		
		$this->addFlash('success', 'Your attribut was successfully deleted');
		return $this->redirect( $this->generateUrl('app_partner_product_list', array('id' => $product->getId())) );
	}
}
