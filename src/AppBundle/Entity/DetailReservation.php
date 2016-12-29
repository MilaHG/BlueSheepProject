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

}
