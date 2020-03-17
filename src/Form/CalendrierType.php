<?php

namespace App\Form;

use App\Entity\Calendrier;
use App\Entity\Candidatures;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendrierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('beginAt')
            ->add('endAt')
            ->add('title')
            ->add('description')
/*            ->add('lieu', EntityType::class, [
                'class' => Candidatures::class,
                'choice_label' => 'titre'
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendrier::class,
        ]);
    }
}
