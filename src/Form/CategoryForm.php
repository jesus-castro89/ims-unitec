<?php
namespace App\Form;
use App\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Id', HiddenType::class);
        $builder->add('Name', TextType::class);
        $builder->add('submit', SubmitType::class, ['label' => 'Enviar']);
    }
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array('data_class'=>Category::class));
    }
}
