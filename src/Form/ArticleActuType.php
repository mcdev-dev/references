<?php

namespace App\Form;

use App\Entity\ArticleActu;
use App\Form\CategorieType;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleActuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class)
            ->add('imageFile', VichImageType::class)
            ->add('contenu', CKEditorType::class)
            ->add('categorie', CategorieType::class, [ 'label' => false ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleActu::class,
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}
