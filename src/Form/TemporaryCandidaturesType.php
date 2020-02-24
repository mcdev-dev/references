<?php

namespace App\Form;

use App\Form\MenageType;
use App\Form\LogementActuelType;
use App\Entity\TemporaryCandidatures;
use App\Form\SituationProFinanciereType;
use Symfony\Component\Form\AbstractType;
use App\Form\InteretHabitatParticipatifType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TemporaryCandidaturesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('logementActuel', LogementActuelType::class, ['label' => false])
            ->add('menage', MenageType::class, ['label' => false])
            ->add('situationProFinanciere', SituationProFinanciereType::class, ['label' => false])
            ->add('interetHabitatParticipatif', InteretHabitatParticipatifType::class, ['label' => false])
            ->add('valider', ChoiceType::class, 
            [
                'choices' => 
                [
                    'J’atteste sur l’honneur l’exactitude des informations renseignées dans le formulaire de candidature. Je suis conscient(e) qu’un formulaire incomplet ou inexact pourrait donner lieu au rejet de ma candidature.' => 'exact',
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
            'data_class' => TemporaryCandidatures::class,
        ]);
    }
}
