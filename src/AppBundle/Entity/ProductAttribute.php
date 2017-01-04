<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProductAttribute
 *
 * @ORM\Table(name="product_attribute")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductAttributeRepository")
 */
class ProductAttribute {

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
	 * @var string
	 * @ORM\Column(name="name", type="string")
	 * @Assert\NotBlank()
	 */
	private $name;
	
	/**
	 *
	 * @var string 
	 * @ORM\Column(name="value", type="string")
	 * @Assert\NotBlank()
	 */
	private $value;
	
	/**
	 *
	 * @var Product
	 * @ORM\ManyToOne(targetEntity="Product", inversedBy="productAttributes")
	 * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false)
	 */
	private $product;
	
	/**
	 *
	 * @var float
	 * @ORM\Column(name="extra_fee", type="float")
	 */
	private $extraFee;


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
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * 
	 * @return string
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * 
	 * @return Product
	 */
	public function getProduct() {
		return $this->product;
	}

	/**
	 * 
	 * @return float
	 */
	public function getExtraFee() {
		return $this->extraFee;
	}

	/**
	 * 
	 * @param string $name
	 * @return $this
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 * 
	 * @param string $value
	 * @return $this
	 */
	public function setValue($value) {
		$this->value = $value;
		return $this;
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
	 * @param float $extraFee
	 * @return $this
	 */
	public function setExtraFee($extraFee) {
		$this->extraFee = $extraFee;
		return $this;
	}
	
	public function __toString() {
		return $this->getName(). ' : ' . $this->getValue(). ' (extrafee : '.$this->getExtraFee().')';
	}
	
}
