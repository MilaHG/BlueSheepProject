<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;


class PhotoType extends AbstractType {

	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('imageFile', VichImageType::class, [
			  'required' => false,
			  //'allow_delete' => false, // not mandatory, default is true
			  'download_link' => true, // not mandatory, default is true
			])
		;
	}

	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults(array(
		  'data_class' => 'AppBundle\Entity\Photo'
		));
	}

	/**
	 * {@inheritdoc}
	 */
	public function getBlockPrefix() {
		return 'appbundle_photo';
	}

}
