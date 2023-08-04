<?php

namespace App\Form;

use App\CategoryQuery;
use App\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextAreaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductForm extends AbstractType
{
    private function explodeCategory(): array
    {
        $query = new CategoryQuery();
        $types = $query->create()
            ->find();
        $choices = [];
        $choices[] = null;
        foreach ($types as $type) {

            $choices[] = $type;
        }
        return $choices;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('Id', HiddenType::class);
        $builder->add('Name', TextType::class, [
            'label' => "Nombre de Producto"
        ]);
        $builder->add('Price', MoneyType::class, [
            'label' => "Precio del Producto",
            'currency' => "MXN"
        ]);
        $builder->add('CategoryId', ChoiceType::class, [
            'choices' => $this->explodeCategory(),
            'choice_label' => function ($category, $key, $index) {

                return !is_null($category) ? $category->getName() : '--Seleccione una categoría de producto--';
            },
            'choice_value' => function ($category = null) {
                if (is_string($category)) {

                    $query = new CategoryQuery();
                    $category = $query->create()->findOneById($category);
                }
                return $category ? $category->getId() : '';
            },
            'label' => 'Categoría de Producto',
            'expanded' => false,
            'multiple' => false
        ]);
        $builder->add('submit', SubmitType::class, ['label' => 'Enviar']);
        $builder->add('cancel', ButtonType::class, [
            'label' => 'Cancelar',
            'attr' => [
                'class' => 'btn btn-danger'
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(array('data_class' => Product::class));
    }
}
