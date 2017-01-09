<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DetailReservation
 *
 * @ORM\Table(name="detail_reservation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DetailReservationRepository")
 */
class DetailReservation {

	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 *
	 * @var Product
	 * 
	 * @ORM\ManyToOne(targetEntity="Product", inversedBy="detailsReservations")
	 * @ORM\JoinColumn(name="id_product", referencedColumnName="id")
	 */
	private $product;
        
        /**
         * ManyToOne unidirectionnel with product attribute 
         * 
         * @ORM\ManyToOne(targetEntity="ProductAttribute")
         * @ORM\JoinColumn(name="id_product_attribute", referencedColumnName="id")
         */
        
        private $product_attribute;
	
	/**
	 * @var int
	 *
	 * @ORM\Column(name="quantity", type="integer")
	 */
	private $quantity;

	/**
	 * @var Reservation
	 * 
	 * @ORM\ManyToOne(targetEntity="Reservation", inversedBy="detailsReservations")
	 * @ORM\JoinColumn(name="id_reservation", referencedColumnName="id")
	 */
	private $reservation;

	public function __toString() {
		return $this->getProduct(). ', quantity :  ' . $this->getQuantity();
	}

		/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set quantity
	 *
	 * @param integer $quantity
	 *
	 * @return DetailReservation
	 */
	public function setQuantity($quantity) {
		$this->quantity = $quantity;

		return $this;
	}

	/**
	 * Get quantity
	 *
	 * @return int
	 */
	public function getQuantity() {
		return $this->quantity;
	}

	/**
	 * 
	 * @return Reservation
	 */
	public function getReservation() {
		return $this->reservation;
	}

	/**
	 * 
	 * @param \AppBundle\Entity\Reservation $reservation
	 * @return \AppBundle\Entity\DetailReservation
	 */
	public function setReservation(Reservation $reservation) {
		$this->reservation = $reservation;
		return $this;
	}
	
	/**
	 * 
	 * @return Entity Product
	 */
	public function getProduct() {
		return $this->product;
	}

	/**
	 * 
	 * @param Product $product
	 * @return $this
	 */
	public function setProduct(Product $product) {
		$this->product = $product;
		return $this;
	}
        
        /**
         * 
         * @return Entity DetailReservation
         */
        public function getProduct_attribute() {
            return $this->product_attribute;
        }

        
        /**
         * 
         * @param type $product_attribute
         * @return \AppBundle\Entity\DetailReservation
         */
        public function setProduct_attribute($product_attribute) {
            $this->product_attribute = $product_attribute;
            return $this;
        }





}
