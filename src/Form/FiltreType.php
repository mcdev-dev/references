<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class FiltreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', ChoiceType::class, [
                'label' => 'Tag de l\'article',
                'choices' => [
                    'habitat participatif' => 'Habitat participatif',
                    'autopromotion' => 'Autopromotion',
                    'concertation' => 'Concertation',
                    'conception et animation d\'événements' => 'Conception et animation d\'événements' ,
                    'développement d’outils numériques' => 'Développement d’outils numériques',
                    'production de contenus éditoriaux' => 'Production de contenus éditoriaux',
                    'accompagnement et conseil stratégiques' => 'Accompagnement et conseil stratégiques'
                ],
                'multiple' => true,
                'constraints' => [
                    new Assert\NotBlank(array(
                        'message' => 'Veuillez renseigner au moins un tag.'
                    )),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
