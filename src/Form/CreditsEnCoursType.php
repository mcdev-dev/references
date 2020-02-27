<?php

namespace App\Form;

use App\Entity\CreditsEnCours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\DataTransformer\FrenchToDateTimeTransformer;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class CreditsEnCoursType extends AbstractType
{
    private $transformer;

    public function __construct(FrenchToDateTimeTransformer $transformer) 
    {
        $this->transformer = $transformer;
    }

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

        $builder->get('dateDebut')->addModelTransformer($this->transformer);
        $builder->get('dateFin')->addModelTransformer($this->transformer);
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
