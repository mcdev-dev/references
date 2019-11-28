<?php

namespace App\Services\EventValidator;

use App\Entity\Event;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;

class EventValidator 
{

    private $validator;
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validateAndUpdate($data, Event $event)
    {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer(null, null, null, new ReflectionExtractor());
        $serializer = new Serializer(array(new DateTimeNormalizer(), $normalizer, new ArrayDenormalizer()), [$encoder]);

        $result = $serializer->deserialize($data, Event::class, 'json', ['object_to_populate' => $event]);   
        $errors = $this->validator->validate($event);

        if(count($errors) > 0){
            throw new \Exception("Données d'évènement non valide");
            //throw new CustomException(Response::HTTP_BAD_REQUEST, (string) $errors);
        }
    }

    public function validateAndCreate($data, $entityClassName)
    {
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer(null, null, null, new ReflectionExtractor());
        $serializer = new Serializer(array(new DateTimeNormalizer(), $normalizer, new ArrayDenormalizer()), [$encoder]);

        $result = $serializer->deserialize($data, $entityClassName, 'json');
        $errors = $this->validator->validate($result);

        if(count($errors) > 0){
            throw new \Exception("Données d'évènement non valide");
            //throw new CustomException(Response::HTTP_BAD_REQUEST, (string) $errors);
        }

        return $result; 
    }
}