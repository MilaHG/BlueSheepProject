<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductAttributeType extends AbstractType {

	private $transformer;


	public function __construct (DataTransformer\ProductToIntTransformer $transformer) {
		$this->transformer = $transformer;
	}

	
	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add(
				'name',
				TextType::class,
				[
				  'label'	=>'Attribute',
				  'attr'		=> array('placeholder' => 'ex: Seat Row'),
				]
			)
			->add(
				'value',
				TextType::class,
				[
				  'label'	=>'Attibute value',
				  'attr'		=> array('placeholder' => 'ex : Premium'),
				]
			)
			->add(
				'extraFee',
				TextType::class,
				[
				  'label'	=>'Extra Fee',
				  'attr'		=> array('placeholder' => 'if applicable'),
				  'required'	=>false,
				]
			)
			->add(
				'product',
				HiddenType::class
			)
//			->add(
//				'product',
//				EntityType::class,
//				[
//				  'class'=>'AppBundle:Product',
//				  'display'=>false,
//				  //'choice_label'=>'name', //champ de l'entité qui s'affiche dans les options
//				]
//			)
		;
		
		$builder->get('product')->addModelTransformer($this->transformer);
	}

	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults(array(
		  'data_class' => 'AppBundle\Entity\ProductAttribute',
		));
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix() {
		return 'appbundle_productattribute';
	}
}
