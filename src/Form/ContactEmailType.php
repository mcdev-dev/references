<?php

namespace App\Form;

use App\Entity\ContactEmail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ContactEmailType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder
        ->add('Subject', TextType::class)
        ->add('Firstname', TextType::class)
        ->add('Lastname', TextType::class)
        ->add('FromEmail', EmailType::class)
        ->add('Company', TextType::class, ['required' => false])
        ->add('PhoneNumber', IntegerType::class, ['required' => false])
        ->add('Content', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactEmail::class,
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }

}