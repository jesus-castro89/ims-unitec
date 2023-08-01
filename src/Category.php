<?php

namespace App;

use App\Base\Category as BaseCategory;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;

/**
 * Skeleton subclass for representing a row from the 'category' table.
 *
 * Tabla para las categorias de productos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 */
#[Type]
class Category extends BaseCategory
{

    #[Field]
    public function getName(): ?string
    {
        return parent::getName(); // TODO: Change the autogenerated stub
    }

    #[Field]
    public function getId(): string
    {
        return parent::getId(); // TODO: Change the autogenerated stub
    }
}
