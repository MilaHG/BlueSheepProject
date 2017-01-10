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
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileType extends AbstractType
{
   

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->buildUserForm($builder, $options);

        $constraintsOptions = array(
            'message' => 'fos_user.current_password.invalid',
        );

        if (!empty($options['validation_groups'])) {
            $constraintsOptions['groups'] = array(reset($options['validation_groups']));
        }

        $builder->add('current_password', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'), array(
            'label' => 'form.current_password',
            'translation_domain' => 'FOSUserBundle',
            'mapped' => false,
            'constraints' => new UserPassword($constraintsOptions),
        ));
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
        return 'fos_user_profile';
    }

    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 
                    null, 
                    array(
                        'label' => 'form.username', 
                        'translation_domain' => 'FOSUserBundle',
                        'required' => FALSE ))
            ->add('email', 
                    LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), 
                    array(
                        'label' => 'form.email', 
                        'translation_domain' => 'FOSUserBundle',
                        'required' => FALSE ))
            
            ->add('current_password', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'), array(
            'label' => 'Mot de passe actuelle',
            'translation_domain' => 'FOSUserBundle',
            'required' => FALSE    
 
            
        ))
                
            ->add('gender', 
                    \Symfony\Component\Form\Extension\Core\Type\TextType::class,
                    array(
                        'label' => 'Civilite'
            )) 
            
            ->add('firstname', 
                    \Symfony\Component\Form\Extension\Core\Type\TextType::class,
                    array(
                        'label' => 'Nom'
                    )) 
            ->add('lastname', 
                    \Symfony\Component\Form\Extension\Core\Type\TextType::class,
                    array(
                        'label' => 'Prenom'
                    )) 
            ->add('city', 
                    \Symfony\Component\Form\Extension\Core\Type\TextType::class,
                    array(
                        'label' => 'Ville'
                    )) 
            ->add('zip', 
                    \Symfony\Component\Form\Extension\Core\Type\TextType::class,
                    array(
                        'label' => 'Code Postal'
                    )) 
                        
            ->add('birthdate',
            \Symfony\Component\Form\Extension\Core\Type\DateType::class,
                    array(
                        'label' => 'Date de naissance',
                        'widget' => 'single_text',
                        
                        'html5' => false,
                        'attr' => ['class' => 'js-datepicker'],
                    ))
            
            ->add('address',
            \Symfony\Component\Form\Extension\Core\Type\TextType::class,
                    array(
                        'label' => 'Adresse'
                    ))
            ->add('photo',
            \Symfony\Component\Form\Extension\Core\Type\FileType::class,
                    array(
                        'label' => 'photo',
                        'required' => FALSE
                    ))
                
            ->add('company',
            \Symfony\Component\Form\Extension\Core\Type\TextType::class,
                    array(
                        'label' => 'Société',
                        'required' => FALSE
                    ))
                
            ->add('commercialRegistry',
            \Symfony\Component\Form\Extension\Core\Type\TextType::class,
                    array(
                        'label' => 'Siret',
                        'required' => FALSE
                    ))
                
        
        ;
    }
    
    
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }
}

