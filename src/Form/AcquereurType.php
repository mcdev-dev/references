<?php

namespace App\Form;

use App\Entity\Acquereur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AcquereurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite', ChoiceType::class, 
            [
                'choices' => 
                [
                    'Madame' => 'madame',
                    'Monsieur' => 'monsieur',
                ],
                'expanded' => true,
                'multiple' => false,
                'attr' => [
                    'class' => 'mb__form__check',
                    'class' => 'form-check-inline',
                ]
            ])
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('dateNaissance', TextType::class, 
            [
                'attr' => ['class' => 'js-datepicker'],
            ])
            ->add('categorieSocioPro', ChoiceType::class, 
            [
                'choices' => 
                [
                    'Agriculteurs exploitants' => 'agriculteurs exploitants',
                    'Artisans, commerçants, chefs d’entreprise' => 'artisans, commerçants, chefs d’entreprise',
                    'Cadre et professions intellectuelles supérieures' => 'cadre et professions intellectuelles supérieures',
                    'Professions intermédiaires' => 'professions intermédiaires',
                    'Employés' => 'employés',
                    'Ouvriers' => 'ouvriers',
                    'Retraités' => 'retraités',
                    'Autres sans activité professionnelle' => 'autres sans activité professionnelle',
                ],
                'expanded' => true,
                'multiple' => false,
                'attr' => [
                    'class' => 'mb__form__check',
                ]
            ])
            ->add('adresse', TextType::class)
            ->add('codePostal', IntegerType::class)
            ->add('ville', TextType::class)
            ->add('phonePortable', TextType::class)
            ->add('phoneDomicile', TextType::class)
            ->add('phonePro', TextType::class)
            ->add('email', EmailType::class)
            ->add('situationFamiliale', ChoiceType::class, 
            [
                'choices' => 
                [
                    'Marié(e)' => 'marié(e)',
                    'Pacsé(e)' => 'pacsé(e)',
                    'En union libre' => 'en union libre',
                    'Célibataire' => 'célibataire',
                    'Divorcé(e)' => 'divorcé(e)',
                    'Veuf/veuve' => 'veuf/veuve',
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
            'data_class' => Acquereur::class,
        ]);
    }
}
