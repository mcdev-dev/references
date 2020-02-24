<?php

namespace App\Form;

use App\Form\MediaType;
use App\Entity\ArticleMulti;
use App\Form\ContenuMultipleType;
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
            ->add('images', CollectionType::class, 
            [
                'label' => 'Images de l\'article',
                'entry_type' => MediaType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true
            ])
            ->add('description', CKEditorType::class)
            ->add('contenu', CollectionType::class, 
            [
                'label' => 'Contenus de l\'article',
                'entry_type' => ContenuMultipleType::class,
                'allow_add' => true,
                'prototype' => true,
            ])
            ;
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
