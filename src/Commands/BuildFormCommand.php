<?php

namespace App\Commands;

use App\Cliente;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

require_once __DIR__ . "/../../config/config.php";

class BuildFormCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('build-form')
            ->setDescription('Crea un Formulario Symfony')
            ->setHelp('Al recibir el nombre de una tabla del esquema actual, permite crear un formulario valido 
            para Symfony Form.')
            ->addArgument('table', InputArgument::REQUIRED, 'Tabla del esquema del proyecto.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $table = $input->getArgument('table');
            $className = $table . "Form";
            $class = 'App\\' . $table;
            $columns = ($class::TABLE_MAP)::getTableMap()->getColumns();
            $formulario = "<?php\n";
            $formulario .= "namespace App\Form;\n";
            $formulario .= "use $class;\n";
            $formulario .= "use Symfony\Component\Form\AbstractType;\n";
            $formulario .= "use Symfony\Component\Form\Extension\Core\Type\IntegerType;\n";
            $formulario .= "use Symfony\Component\Form\Extension\Core\Type\SubmitType;\n";
            $formulario .= "use Symfony\Component\Form\Extension\Core\Type\TextType;\n";
            $formulario .= "use Symfony\Component\Form\Extension\Core\Type\NumberType;\n";
            $formulario .= "use Symfony\Component\Form\Extension\Core\Type\TextAreaType;\n";
            $formulario .= "use Symfony\Component\Form\FormBuilderInterface;\n";
            $formulario .= "use Symfony\Component\OptionsResolver\OptionsResolver;\n";
            $formulario .= "\n";
            $formulario .= "class $className extends AbstractType\n";
            $formulario .= "{\n";
            $formulario .= "    public function buildForm(FormBuilderInterface \$builder, array \$options)\n";
            $formulario .= "    {\n";
            foreach ($columns as $campo) {
                $nombreCampo = $campo->getPhpName();
                $tipoCampo = $campo->getType();

                switch ($tipoCampo) {
                    case 'INTEGER':
                    case 'SMALLINT':
                        $formulario .= "        \$builder->add('$nombreCampo', IntegerType::class);\n";
                        break;
                    case 'VARCHAR':
                        $formulario .= "        \$builder->add('$nombreCampo', TextType::class);\n";
                        break;
                    case 'LONGVARCHAR':
                        $formulario .= "        \$builder->add('$nombreCampo', TextAreaType::class);\n";
                        break;
                    case 'DECIMAL':
                        $formulario .= "        \$builder->add('$nombreCampo', NumberType::class);\n";
                        break;
                    // Agregar más casos según los tipos de datos que necesites manejar
                    default:
                        $formulario .="        /* FALTA EL TIPO $tipoCampo para $nombreCampo */\n";
                        // Tipo de dato no reconocido, puedes agregar algún mensaje o función para manejarlo
                        break;
                }
            }

            $formulario .= "        \$builder->add('submit', SubmitType::class, ['label' => 'Enviar']);\n";
            $formulario .= "    }\n";
            $formulario .= "    public function configureOptions(OptionsResolver \$resolver){\n";
            $formulario .= "        \$resolver->setDefaults(array('data_class'=>$table::class));\n";
            $formulario .= "    }\n";
            $formulario .= "}\n";
            // Guardar el código generado en un archivo o utilizarlo directamente
            file_put_contents('src/Form/' . $className . '.php', $formulario);
        } catch (\Exception $exception) {
            $output->writeln(messages: "{$exception->getTraceAsString()}");
        }
        return 0;
    }
}
