<?php
namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductToIntTransformer
 *
 * @author Etudiant
 */
class ProductToIntTransformer implements DataTransformerInterface
{
	private $em;


	public function __construct(EntityManager $em) {
		$this->em = $em;
	}
	
	//put your code here
	public function reverseTransform($value) {
		if (!empty($value)) {
			return $this->em->getReference('AppBundle:Product', $value);
		}
	}

	public function transform($value) {
		if ($value instanceof Product) {
			return $value->getId();
		}
	}

}
