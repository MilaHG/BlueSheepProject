<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType {

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add(
				'stock',
				TextType::class,
				[
				  'label'=>'Stock',
				]
			)
			->add(
				'price',
				TextType::class,
				[
				  'label'=>'Price (€)',
				]
			)
			->add(
				'date',
				DateTimeType::class,
				[
				  'label'=>'Date',
				]
			)
			/*->add(
				'activity',
				EntityType::class,
				[
				  'label'=>'Activity',
				  'class'=>'AppBundle:Activity', //nom de l'entité
				  'choice_label'=>'title', //champ de l'entité qui s'affiche dans les options
				]
			)*/
		;
	}

	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults(array(
		  'data_class' => 'AppBundle\Entity\Product'
		));
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix() {
		return 'appbundle_product';
	}

}
