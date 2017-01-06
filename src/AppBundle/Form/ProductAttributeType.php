<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductAttributeType extends AbstractType {

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
		;
	}

	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults(array(
		  'data_class' => 'AppBundle\Entity\ProductAttribute'
		));
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix() {
		return 'appbundle_productattribute';
	}
}
