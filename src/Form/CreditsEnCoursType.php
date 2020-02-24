<?php

namespace App\Form;

use App\Entity\CreditsEnCours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class CreditsEnCoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebut', TextType::class, 
            [
                'attr' => ['class' => 'js-datepicker'],
                'label' => 'Date de début',
            ])
            ->add('dateFin', TextType::class, 
            [
                'attr' => ['class' => 'js-datepicker'],
                'label' => 'Date de fin',
            ])
            ->add('mensualites', MoneyType::class, [
                'label' => 'Mensualités',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CreditsEnCours::class,
            'attr' => 
            [
                'class' => 'credits__en__cours'
            ]
        ]);
    }
}
