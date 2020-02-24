<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\InteretHabitatParticipatif;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class InteretHabitatParticipatifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('motivations', TextareaType::class)
            ->add('contributionProjet', TextareaType::class)
            ->add('vieVoisinage', TextareaType::class)
            ->add('connaisanceProjet', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InteretHabitatParticipatif::class,
        ]);
    }
}
