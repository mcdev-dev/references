<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class FrenchToDateTimeTransformer implements DataTransformerInterface
{
    public function transform($date) 
    {
        if(null === $date) return '';
    
        return $date->format('d/m/Y');
    }

    public function reverseTransform($french_date) 
    {
        if(null === $french_date) throw new TransformationFailedException;

        $date = \DateTime::createFromFormat('d/m/Y', $french_date);

        if($date === false) throw new TransformationFailedException;

        return $date;
    }
}