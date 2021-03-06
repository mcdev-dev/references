<?php

namespace App\Form;

use App\Entity\MediaReference;
use Symfony\Component\Validator\Constraints\File;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MediaReferenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', VichImageType::class,
                [
                    'required' => false,
                    'download_uri' => true,
                    'image_uri' => true,
                    'label' => false,
                    'constraints' => [
                        new File([
                            'maxSize' => '20M',
                            'mimeTypes' => [
                                'image/jpeg',
                                'image/png',
                                'image/svg',
                                'application/pdf',
                                'application/x-pdf'
                            ],
                            'mimeTypesMessage' => 'Veuillez choisir un fichier PDF, JPEG ou PNG'
                        ])
                    ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MediaReference::class,
        ]);
    }
}
