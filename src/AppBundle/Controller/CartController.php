<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CartController extends Controller
{
    /**
     * @Route("/cart")
     */
    public function cartAction(Request $request)
    {
        
        $session = $request->getSession();
 
        $cart = $session->get('cart');
        $set = $session->get('set');
        return $this->render('AppBundle:Cart:cart.html.twig', array(
            'cart' => $cart,
            'set' => $set
            // ...
        ));
    }

    /**
     * @Route("/cart/add")
     */
    public function addAction(Request $request)
    {
        
        if($request->getMethod()=='POST'){
            
            $id_product = $request->get('id_product');
            $id_activity = $request->get('id_activity');
            $qty = $request->get('qty');
            $activity_title = $request->get('activity_title');
            $activity_description = $request->get('activity_description');
            $product_price = $request->get('product_price');
 
                    
         $session = $request->getSession();
        
        if($session->has('cart')){
      
            $cart = $session->get('cart');
            $set = $session->set('set', 'Cart defini je push');
//            $cart['id_product'][] = $id_product;
//            $cart['id_activity'][] = $id_activity;
//            $cart['qty'][]= $qty;
//            $cart['activity_title'][]= $activity_title;
//            $cart['activity_description'][]= $activity_description;
//            $cart['product_price'][]= $product_price;
            
            // Contrainte :  Si le produit existe deja dans le panier, additionner juste la quantité 
            
            $cart[] = [
                
            'id_product'            => $id_product,
            'id_activity'           => $id_activity,
            'qty'                   => $qty,
            'activity_title'        => $activity_title,
            'activity_description'  => $activity_description,
            'product_price'         => $product_price,
                
            ];
 
            $session->set('cart', $cart);
            
        }else{
            
            
            $cart = array(array(
                
            'id_product'            => $id_product,
            'id_activity'           => $id_activity,
            'qty'                   => $qty,
            'activity_title'        => $activity_title,
            'activity_description'  => $activity_description,
            'product_price'         => $product_price,
                
            ));
              $set = $session->set('set','cart non defini, je cree');
            
//            $cart = $session->set('cart', array(
//            'id_product'   => array($id_product),
//            'id_activity'   => array($id_activity),
//            'qty'       => array($qty),
//            'activity_title'       => array($activity_title),
//            'activity_description'       => array($activity_description),
//            'product_price'       => array($product_price),
//             
//        ));
              
              $cart = $session->set('cart', $cart);
            
            
        }
            
        }
        else{
            
            $this->redirectToRoute('homepage');
        }
        
        return $this->redirectToRoute('app_cart_cart');

        
        

        return $this->render('AppBundle:Cart:add.html.twig', array(
            
            'cart' => $cart,
            'set' => $set
            // ...
        ));
    }

    /**
     * @Route("/cart/edit")
     */
    public function editAction()
    {
        return $this->render('AppBundle:Cart:edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/cart/delete/{id}")
     */
    public function deleteAction()
    {
        return $this->render('AppBundle:Cart:delete.html.twig', array(
            // ...
        ));
    }
    
    
    /**
     * @Route("/checkout")
     * 
     */
    public function checkoutAction(Request $request) {
        
        // Etapes checkout 
        // 1. login si le client n'est loggué, inscription s'il n'a pas de compte 
        // 2. recapitulatif de la commande 
        // 3. Acceptation des conditiosn générales 
        // 4. Finalisation de la commande : mails de confirmation client et fournisseurs 
        
        if(!$this->getUser()){
            
          return  $this->redirectToRoute('fos_user_security_login');
            
        }
        $cart = $request->getSession()->get('cart');
        
        return $this->render('AppBundle:Cart:checkout.html.twig', [
            
            'cart' => $cart
 
        ]);
        
    }
    
    /**
     * @Route("/bookingSuccess/")
     */
    public function bookingAction(Request $request) {
        
        $em = $this->getDoctrine()->getManager();
        $booking = new \AppBundle\Entity\Reservation();
        $bookingDetail = new \AppBundle\Entity\DetailReservation();
        
        $booking->setDate(new \DateTime());
        $booking->setUser($this->getUser());
        $em->persist($booking);
        $em->flush(); 
        $booking_id = $booking->getId();
        // retrieve product and product quantity from session('cart')
        $cart = $request->getSession()->get('cart');
         
       
   
  
        foreach ($cart as $item) {
            
            $em = $this->getDoctrine()->getManager();
            $id_product = $item['id_product'];
            $quantity = $item['qty'];
            $product = $em->find('AppBundle:Product', $id_product);
            $booking = $em->find('AppBundle:Reservation', $booking_id);
            $bookingDetail->setProduct($product);
            $bookingDetail->setReservation($booking);
            $bookingDetail->setQuantity($quantity);
            $em->persist($bookingDetail);
            
            $em->flush();
            $em->clear();

            
   
        }
        
        $em->clear();
        $em->flush();
        $request->getSession()->remove('cart');
        
        return $this->render('AppBundle:Cart:bookingSuccess.html.twig', [
            
        ]);
        
        
        
    }

}
