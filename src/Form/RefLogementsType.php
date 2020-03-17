<?php

namespace App\Form;

use App\Entity\RefLogements;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RefLogementsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class)
            ->add('images', CollectionType::class,
                [
                    'label' => 'Images de l\'article',
                    'entry_type' => MediaReferenceType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true
                ])
            ->add('description', CKEditorType::class)
            ->add('contenuReference', CollectionType::class,
                [
                    'label' => 'Contenus de l\'article',
                    'entry_type' => ContenuReferenceType::class,
                    'allow_add' => true,
                    'prototype' =>true
                ])
            ->add('categorie', CategorieType::class, [ 'label' => false ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RefLogements::class,
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}
