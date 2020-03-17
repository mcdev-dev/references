<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('civilite', ChoiceType::class, [
                'choices' => [
                    'Monsieur' => 'm',
                    'Madame' => 'f',
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => ['label' => false],
                'second_options' => ['label' => false],
                'invalid_message' => 'Les deux mots de passe doivent être identiques',
                'options' => [
                    'attr' => [
                        'class' => 'password-field'
                    ]
                ],
                'required' => true,
            ])
            ->add('nom', TextType::class, [
                'trim' => true,
            ])
            ->add('prenom', TextType::class, [
                'trim' => true,
            ])
            ->add('email', EmailType::class, [
                'trim' => true,
            ])
            ->add('abonneNewsletter', CheckboxType::class, [
                'required' => false,
                'label' => false,
            ])
            ->add('cguAccepted', CheckboxType::class, [
                'required' => false,
                'label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}
