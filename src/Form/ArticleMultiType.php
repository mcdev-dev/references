<?php

namespace App\Form;

use App\Form\MediaType;
use App\Entity\ArticleMulti;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ArticleMultiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class)
            ->add('images', CollectionType::class, [
                'entry_type' => MediaType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true
            ])
            ->add('description', CKEditorType::class)
            ->add('transport', CKEditorType::class)
            ->add('santeServicesSociaux', CKEditorType::class)
            ->add('servicesAdmin', CKEditorType::class)
            ->add('education', CKEditorType::class)
            ->add('sports', CKEditorType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleMulti::class,
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}
