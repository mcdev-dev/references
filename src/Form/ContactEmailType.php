<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ContactEmailType extends AbstractType 
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder
        ->add('Subject', TextType::class, ['label' => 'Objet'])
        ->add('Firstname', TextType::class, ['label' => 'Prénom'])
        ->add('Lastname', TextType::class, ['label' => 'Nom'])
        ->add('FromEmail', EmailType::class, ['label' => 'Email'])
        ->add('Company', TextType::class, ['label' => 'Société', 'required' => false])
        ->add('PhoneNumber', TelType::class, ['label' => 'Téléphone', 'required' => false])
        ->add('Content', TextareaType::class, ['label' => 'Contenu de l\'email'])
        ->add('SaveAndSend', SubmitType::class, ['label' => 'Envoyer']);
    }
}