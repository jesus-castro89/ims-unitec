<?php


namespace App\Form;


use App\Cliente;
use App\EmpleadoQuery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ClienteForm extends AbstractType
{

    private function explodeRepresentantes()
    {

        $query = new EmpleadoQuery();
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
        $builder
            ->add('codigoCliente', HiddenType::class)
            ->add('nombreCliente', TextType::class, [
                'label' => 'Nombre del Cliente'
            ])
            ->add('nombreContacto', TextType::class, [
                'label' => 'Nombre de Empleado de Contacto'
            ])
            ->add('telefono', NumberType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Regex('/^(\+\d{1,2}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/')
                ],
                'label' => 'Teléfono de Contacto'
            ])
            ->add('fax', NumberType::class, [
                'required' => false,
                'constraints' => [
                    new Regex('/^(\+\d{1,2}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/')
                ],
                'label' => 'Fax de Contacto'
            ])
            ->add('lineaDireccion1', TextType::class)
            ->add('lineaDireccion2', TextType::class)
            ->add('ciudad', TextType::class)
            ->add('region', TextType::class)
            ->add('pais', TextType::class)
            ->add('codigoPostal', NumberType::class)
            ->add('limiteCredito', MoneyType::class, [
                'currency' => 'USD'
            ])
            ->add('codigoEmpleadoRepVentas', ChoiceType::class, [
                'choices' => $this->explodeRepresentantes(),
                'choice_label' => function ($category, $key, $index) {

                    return $category != null ? $category->getNombre() : '--Seleccione una categoria de ingrediente--';
                },
                'choice_value' => function ($category = null) {
                    if (is_int($category)) {

                        $query = new EmpleadoQuery();
                        $category = $query->create()
                            ->findOneByCodigoEmpleado($category);
                    }
                    return $category ? $category->getCodigoEmpleado() : '';
                },
                'label' => 'Representante de Ventas',
                'expanded' => false,
                'multiple' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults(array(
            'data_class' => Cliente::class
        ));
    }
}
