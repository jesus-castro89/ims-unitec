<?php

namespace App\Form;

use App\Client;
use App\Form\Type\ZipCodeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextAreaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('ClientId', HiddenType::class);
        $builder->add('ClientName', TextType::class, [
            'label' => 'Nombre del Cliente'
        ]);
        $builder->add('ClientLastName', TextType::class, [
            'label' => 'Apellido(s) del Cliente'
        ]);
        $builder->add('ClientAdress', TextAreaType::class, [
            'label' => 'Dirección del Cliente'
        ]);
        $builder->add('ClientZipCode', ZipCodeType::class, [
            'label' => 'Código postal del Cliente'
        ]);
        $builder->add('submit', SubmitType::class, [
            'label' => 'Enviar',
            'attr' => [
                'class' => 'btn btn-primary'
            ]
        ]);
        $builder->add('cancel', ButtonType::class, [
            'label' => 'Cancelar',
            'attr' => [
                'class' => 'btn btn-danger'
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(array('data_class' => Client::class));
    }
}
