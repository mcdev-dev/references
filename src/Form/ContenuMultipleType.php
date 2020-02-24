<?php

namespace App\Form;

use App\Entity\ContenuMultiple;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContenuMultipleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [ 'label' => 'Sous-titre de l\'article' ])
            ->add('contenu', CKEditorType::class, [ 'label' => 'Contenu du sous-titre' ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContenuMultiple::class,
        ]);
    }
}
