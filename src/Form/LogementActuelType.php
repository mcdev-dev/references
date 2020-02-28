<?php

namespace App\Form;

use App\Entity\LogementActuel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class LogementActuelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('logementRecherche', ChoiceType::class, 
            [
                'label' => false,
                'choices' => 
                [
                    '2 pièces (T2)' => '2 pièces (T2)',
                    '3 pièces (T3)' => '3 pièces (T3)',
                    '4 pièces (T4)' => '4 pièces (T4)',
                ],
                'expanded' => true,
                'multiple' => true,
                'attr' => [
                    'class' => 'form-check-inline',
                ]
                
            ])
            ->add('surfaceMinimale', IntegerType::class, 
            [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Surface minimale'
                ]
            ])
            ->add('surfaceMaximale', IntegerType::class, 
            [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Surface maximale'
                ]
            ])
            ->add('logementActuel', ChoiceType::class, 
            [
                'label' => false,
                'choices' => 
                [
                    '1 pièce' => '1 pièce',
                    '2 pièces' => '2 pièces',
                    '3 pièces' => '3 pièces',
                    '4 pièces' => '4 pièces',
                    '5 pièces et plus' => '5 pièces et plus',
                ],
                'expanded' => true,
                'multiple' => false,
                'attr' => [
                    'class' => 'form-check-inline'
                ]
                
            ])
            ->add('statutOccupation', ChoiceType::class, 
            [
                'label' => false,
                'empty_data' => '',
                'choices' => 
                [
                    'Locataire du parc privé' => 'Locataire du parc privé',
                    'Propriétaire occupant' => 'Propriétaire occupant',
                    'Locataire HLM' => 'Locataire HLM',
                    'Autre (veuillez préciser) :' => false,
                ],
                'expanded' => true,
                'multiple' => false,
                'attr' => [
                    'class' => 'mb__form__check'
                ],
                
            ])
            ->add('montantLoyer', MoneyType::class, ['label' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LogementActuel::class,
            'attr' => 
            [
                'novalidate' => 'novalidate',
            ]
        ]);
    }
}
