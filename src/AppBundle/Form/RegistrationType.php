<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{


    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', 
                    ChoiceType::class,
                    array(
                        'choices' => array(
                          
                            'Monsieur' => 'M',
                            'Madame' => 'MME'
                        ),
                        'label' => 'Civilite'
                        ))  
                
            ->add('firstname',
            TextType::class,
                    array(
                        'label' => 'Nom'
                    ))  
                
            ->add('lastname',
            TextType::class,
                    array(
                        'label' => 'Prenom'
                    ))
            
            ->add('birthdate',
            \Symfony\Component\Form\Extension\Core\Type\DateType::class,
                    array(
                        'label' => 'Date de naissance'
                    ))
            ->add('address',
            TextType::class,
                    array(
                        'label' => 'Adresse'
                    )) 
                
            ->add('zip',
            TextType::class,
                    array(
                        'label' => 'Code postal'
                    )) 
                
            ->add('city',
            TextType::class,
                    array(
                        'label' => 'Ville'
                    )) 
                
            ->add('photo',
            \Symfony\Component\Form\Extension\Core\Type\FileType::class,
                    array(
                        'label' => 'Photo',
                        'required' => FALSE
                    ))    
                

        ;
    }

 

    // BC for SF < 3.0
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
}