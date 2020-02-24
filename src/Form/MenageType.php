<?php

namespace App\Form;

use App\Entity\Menage;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\DataTransformer\FrenchToDateTimeTransformer;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MenageType extends AbstractType
{

    private $transformer;

    public function __construct(FrenchToDateTimeTransformer $transformer) 
    {
        $this->transformer = $transformer;
    }

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
            ->add('coAcquereur', TextType::class)
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
            ->add('personnesACharges1', CKEditorType::class, 
            [
                'config' => array('toolbar' => 'basic'),
            ])
            ->add('personnesACharges2', CKEditorType::class, 
            [
                'config' => array('toolbar' => 'basic'),
            ])
            ->add('personnesACharges3', CKEditorType::class, 
            [
                'config' => array('toolbar' => 'basic'),
            ])
            ->add('personnesACharges4', CKEditorType::class, 
            [
                'config' => array('toolbar' => 'basic'),
            ])
            ->add('tailleFoyer', TextType::class)
        ;
        //$builder->get('dateNaissance')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Menage::class,
        ]);
    }
}
