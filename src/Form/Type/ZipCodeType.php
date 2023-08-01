<?php

namespace App\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ZipCodeType extends \Symfony\Component\Form\AbstractType
{

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'label' => 'Código Postal',
            'constraints' => [
                new NotBlank(),
                new Regex('/^[0-9]{5}(?:-[0-9]{4})?$/')
            ]
        ]);
    }

    public function getParent(): string
    {
        return NumberType::class;
    }
}