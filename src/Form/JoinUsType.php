<?php

namespace App\Form;

use App\Entity\JoinUs;
use App\Form\MediaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class JoinUsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('email', EmailType::class)
            ->add('telephone', TelType::class, ['required' => false])
            ->add('subject', TextType::class)
            ->add('message', TextareaType::class)
            ->add('cv', MediaType::class, 
            [
                'label' => 'CV'
            ])
            ->add('lettreMotivation', MediaType::class, [ 
                'label' => 'Lettre de motivation'
                ])
            ->add('book', MediaType::class, [ 
                'label' => 'Autre document'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JoinUs::class,
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}
