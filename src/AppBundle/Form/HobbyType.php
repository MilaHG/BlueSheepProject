<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HobbyType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'note',
                ChoiceType::class,
                    [
                        'choices' => 
                        [
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5'
                        ],
                        'label' => 'Note',
//                        'class' => 'AppBundle:Hobby',
//                        'choice_label'  => 'note',
                        'placeholder'   => 'Select'
                    ]
            )
//            ->add(
//                'user'
//            )
            ->add(
                'category',
                EntityType::class,
                    [
                        'label' => 'Category',
                        'class' => 'AppBundle:Category',
                        'choice_label'  => 'name',
                        'placeholder'   => 'Select a category'
                    ]
            )
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Hobby'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_hobby';
    }


}
