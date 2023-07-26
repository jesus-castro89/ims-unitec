<?php

namespace App\Form;

use App\EmpleadoQuery;
use App\GamaProductoQuery;
use App\Producto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextAreaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Constraints\Regex;

class ProductoFormulario extends AbstractType
{
    private function explodeGama()
    {

        $query = new GamaProductoQuery();
        $types = $query->create()
            ->find();
        $choices = [];
        $choices[] = null;
        foreach ($types as $type) {

            $choices[] = $type;
        }
        return $choices;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('CodigoProducto', TextType::class, [
            'label' => 'Código del Producto'
        ]);
        $builder->add('Nombre', TextType::class, [
            'label' => 'Nombre del Producto'
        ]);
        $builder->add('Gama', ChoiceType::class, [
            'choices' => $this->explodeGama(),
            'choice_label' => function ($category, $key, $index) {

                return $category != null ? $category->getGama() : '--Seleccione una Gama para el producto--';
            },
            'choice_value' => function ($category = null) {
                if (is_string($category)) {

                    $query = new GamaProductoQuery();
                    $category = $query->create()
                        ->findOneByGama($category);
                }
                return $category ? $category->getGama() : '';
            },
            'label' => 'Gama del Producto',
            'expanded' => false,
            'multiple' => false
        ]);
        $builder->add('Dimensiones', TextType::class, [
            'label' => 'Dimensiones del Producto'
        ]);
        $builder->add('Proveedor', TextType::class, [
            'label' => 'Proveedor del Producto'
        ]);
        $builder->add('Descripcion', TextAreaType::class, [
            'label' => 'Descripción del Producto'
        ]);
        $builder->add('CantidadEnStock', IntegerType::class, [
            'label' => 'Cantidad en Stock',
            'constraints' => [
                new PositiveOrZero()
            ],
        ]);
        $builder->add('PrecioVenta', MoneyType::class, [
            'label' => 'Precio de Venta del Producto',
            'currency' => 'USD',
            'constraints' => [
                new Positive()
            ],
        ]);
        $builder->add('PrecioProveedor', MoneyType::class, [
            'label' => 'Precio de Venta para Proveedores',
            'currency' => 'USD',
            'constraints' => [
                new Positive()
            ],
        ]);
        $builder->add('submit', SubmitType::class, ['label' => 'Enviar']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => Producto::class));
    }
}
