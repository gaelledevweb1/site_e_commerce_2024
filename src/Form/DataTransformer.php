<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

//   birthday : transformer la date en string  pour eviter le conflit entre mon registrationTypeForm et mon entity User

 


// $birthday = 12/04/2022;
// $birthday = '12/04/2022';
// $date= date('d/m/Y');


class StringToDateTransformer implements DataTransformerInterface{
    public function transform($date){
        if (null === $date) {
            return '';
        }

        var_dump($date);

        if (!$date instanceof \DateTime) {
            throw new TransformationFailedException('Expected a \DateTime.');
        }
    
        return $date->format('d/m/Y');
    }

    public function reverseTransform($dateString)
    {
        if (!$dateString) {
            return null;
        }

        $date = \DateTime::createFromFormat('d/m/Y', $dateString);

        if (!$date) {
            throw new TransformationFailedException('Invalid date format.');
        }

        return $date;
    }
    
    
}






