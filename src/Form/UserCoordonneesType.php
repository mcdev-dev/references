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
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('telephone', IntegerType::class)
            ->add('civilite', ChoiceType::class, [
                'choices' => [
                    'Monsieur' => 'm',
                    'Madame' => 'f'
                ]
            ])
            ->add('pays', TextType::class)
            ->add('ville', TextType::class)
            /*->add('role', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Administrateur' => 'ROLE_ADMIN',
                    'Super admin' => 'ROLE_SUPER_ADMIN'
                ]
            ])*/
            ->add('codePostal', IntegerType::class)
            ->add('adresse', TextareaType::class)
            ->add('imageFile', VichImageType::class)
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
