<?php

namespace App\Form;

use App\Entity\UserCoordonnees;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserCoordonneesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('telephone', IntegerType::class, [ 'label' => 'Téléphone' ])
            ->add('pays', TextType::class)
            ->add('ville', TextType::class)
            ->add('codePostal', IntegerType::class)
            ->add('adresse', TextareaType::class)
            ->add('imageFile', VichImageType::class, [ 
                'label' => false,
                //'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserCoordonnees::class,
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}
