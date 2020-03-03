<?php

namespace App\Form;

use App\Entity\Menage;
use App\Form\AcquereurType;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\DataTransformer\FrenchToDateTimeTransformer;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class MenageType extends AbstractType
{

    private $transformer;

    public function __construct(FrenchToDateTimeTransformer $transformer) 
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('coAcquereur', TextType::class)
            ->add('personnesACharges1', CKEditorType::class, 
            [
                'config' => array('toolbar' => 'basic'),
            ])
            ->add('personnesACharges2', CKEditorType::class, 
            [
                'config' => array('toolbar' => 'basic'),
            ])
            ->add('personnesACharges3', CKEditorType::class, 
            [
                'config' => array('toolbar' => 'basic'),
            ])
            ->add('personnesACharges4', CKEditorType::class, 
            [
                'config' => array('toolbar' => 'basic'),
            ])
            ->add('tailleFoyer', TextType::class)
            ->add('acquereur', AcquereurType::class)
            ->add('coAcquereur', AcquereurType::class)
        ;
        //$builder->get('dateNaissance')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Menage::class,
        ]);
    }
}
