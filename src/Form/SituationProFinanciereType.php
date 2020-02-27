<?php

namespace App\Form;

use App\Form\CreditsEnCoursType;
use App\Entity\SituationProFinanciere;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SituationProFinanciereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('acquereurStatutEmploi', ChoiceType::class, 
            [
                'choices' => 
                [
                    'CDI' => 'CDI',
                    'CDD' => 'CDD',
                    'Intérim' => 'Intérim',
                    'Travailleur indépendant' => 'Travailleur indépendant',
                    'Retraité' => 'Retraité',
                    'Autre (veuillez préciser) :' => false,
                ],
                'expanded' => true,
                'multiple' => false,
                'attr' => [
                    'class' => 'mb__form__check',
                ]
            ])
            ->add('acquereurSalaireMensuelMoyen', MoneyType::class)
            ->add('acquereurRevenusImpos', MoneyType::class)
            ->add('coAcquereurStatutEmploi', ChoiceType::class, 
            [
                'choices' => 
                [
                    'CDI' => 'CDI',
                    'CDD' => 'CDD',
                    'Intérim' => 'Intérim',
                    'Travailleur indépendant' => 'Travailleur indépendant',
                    'Retraité' => 'Retraité',
                    'Autre (veuillez préciser) :' => false,
                ],
                'expanded' => true,
                'multiple' => false,
                'attr' => [
                    'class' => 'mb__form__check',
                ]
            ])
            ->add('coAcquereurSalaireMensuelMoyen', MoneyType::class)
            ->add('coAcquereurRevenusImpos', MoneyType::class)
            ->add('sourceRevenus1', CKEditorType::class, 
            [
                'config' => array('toolbar' => 'basic'),
            ])
            ->add('sourceRevenus2', CKEditorType::class, 
            [
                'config' => array('toolbar' => 'basic'),
            ])
            ->add('sourceRevenus3', CKEditorType::class, 
            [
                'config' => array('toolbar' => 'basic'),
            ])
            ->add('creditEnCours1', CreditsEnCoursType::class, [ 'required' => false ])
            ->add('creditEnCours2', CreditsEnCoursType::class, [ 'required' => false ])
            ->add('creditEnCours3', CreditsEnCoursType::class, [ 'required' => false ])
            ->add('apportPersonnel', ChoiceType::class, 
            [
                'choices' => 
                [
                    'Non' => 'non',
                    'Oui' => false,
                ],
                'expanded' => true,
                'multiple' => false,
                'attr' => [
                    'class' => 'mb__form__check',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SituationProFinanciere::class,
        ]);
    }
}
