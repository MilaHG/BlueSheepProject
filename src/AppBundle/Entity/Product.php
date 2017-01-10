<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Activity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;


/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product {

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
	 * @var integer 
	 * @ORM\Column(name="stock", type="integer")
	 * @Assert\GreaterThanOrEqual(
	 * value = 0,
	 * message="This value should be greater than or equal to {{ compared_value }}."
	 * )
	 * 
	 */
	private $stock;

	/**
	 *
	 * @var float
	 * @ORM\Column(name="price", type="float")
	 * @Assert\NotBlank()
	 */
	private $price;

	/**
	 *
	 * @var DateTime
	 * @ORM\Column(name="date", type="datetime")
	 */
	private $date;

	/**
	 *
	 * @var Activity
	 * @ORM\ManyToOne (targetEntity="Activity", inversedBy="products")
	 * @ORM\JoinColumn (name="activity_id", referencedColumnName="id", nullable=false)
	 */
	private $activity;

	/**
	 *
	 * @var ArrayCollection
	 * @ORM\OneToMany(targetEntity="ProductAttribute", mappedBy="product")
	 */
	private $productAttributes;
	
	
	/**
	 *
	 * @var ArrayCollection
	 * @ORM\OneToMany(targetEntity="DetailReservation", mappedBy="product")
	 */
	private $detailsReservations;
	
	public function __toString() {
		return $this->getActivity()->getTitle() . ' - ' . $this->getDate()->format('d/m/Y H:i:s') . ' (toString Method)';
	}
	
	public function __construct() {
		$this->productAttributes = new ArrayCollection();
		$this->detailsReservations = new ArrayCollection();
		$this->date= new DateTime;
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
	 * 
	 * @return int
	 */
	public function getStock() {
		return $this->stock;
	}

	/**
	 * 
	 * @return float
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * 
	 * @return DateTime
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * 
	 * @return Activity
	 */
	public function getActivity() {
		return $this->activity;
	}

	/**
	 * 
	 * @return ArrayCollection
	 */
	public function getProductAttributes() {
		return $this->productAttributes;
	}

	/**
	 * 
	 * @param int $stock
	 * @return $this
	 */
	public function setStock($stock) {
		$this->stock = $stock;
		return $this;
	}

	/**
	 * 
	 * @param float $price
	 * @return $this
	 */
	public function setPrice($price) {
		$this->price = $price;
		return $this;
	}

	/**
	 * 
	 * @param DateTime $date
	 * @return $this
	 */
	public function setDate(DateTime $date) {
		$this->date = $date;
		return $this;
	}

	/**
	 * 
	 * @param Activity $activity
	 * @return $this
	 */
	public function setActivity(Activity $activity) {
		$this->activity = $activity;
		return $this;
	}

	/**
	 * 
	 * @return ArrayCollection
	 */
	public function getDetailsReservations() {
		return $this->detailsReservations;
	}

	/**
	 * 
	 * @param ArrayCollection $detailsReservations
	 * @return $this
	 */
	public function setDetailsReservations(ArrayCollection $detailsReservations) {
		$this->detailsReservations = $detailsReservations;
		return $this;
	}
	
	/**
	 * 
	 * @param ArrayCollection $productAttributes
	 * @return $this
	 */
	public function setProductAttributes(ArrayCollection $productAttributes) {
		$this->productAttributes = $productAttributes;
		return $this;
	}

	

}
