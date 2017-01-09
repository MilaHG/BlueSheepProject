<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Form\PhotoType;

class ActivityType extends AbstractType {

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add(
				'participantSolo',
				CheckboxType::class,
				[
				  'label'=>'Solo',
				   'required'=>false,
				]
			)
			->add(
				'participantDuo',
				CheckboxType::class,
				[
				  'label'=>'Duo',
				   'required'=>false,
				]
			)
			->add(
				'participantFamily',
				CheckboxType::class,
				[
				  'label'=>'Family',
				   'required'=>false,
				]
			)
			->add(
				'participantFriend',
				CheckboxType::class,
				[
				  'label'=>'Friend',
				   'required'=>false,
				]
			)
			->add(
				'title',
				TextType::class,
				[
				  'label'=>'Title',
				]
			)
			->add(
				'description',
				TextareaType::class,
				[
				  'label'=>'Description',
				]
			)
			->add(
				'category',
				EntityType::class,
				[
				  'label'=>'Category',
				  'class'=>'AppBundle:Category',
				  'choice_label'=>'name',
				  'placeholder' => 'Choose a category'
				]
			)
			->add(
				'address',
				TextareaType::class,
				[
				  'label'=>'Address',
				]
			)
			->add(
				'zip',
				TextType::class,
				[
				  'label'=>'Zip code',
				]
			)
			->add(
				'city',
				TextType::class,
				[
				  'label'=>'City',
				]
			)
			->add(
				'photos',
				CollectionType::class,
				[
					'entry_type' => PhotoType::class,
					'allow_add' => true,
					'allow_delete' => true
				]
			)
		;
	}

	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults(array(
		  'data_class' => 'AppBundle\Entity\Activity'
		));
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix() {
		return 'appbundle_activity';
	}
}
