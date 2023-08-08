<?php

namespace App;

use TheCodingMachine\GraphQLite\Annotations\Type;

#[Type]
enum ProductField: string
{
    case ALL = '';
    case ID = 'id';
    case NAME = 'name';
    case PRICE = 'price';
    case CATEGORY = 'category';
}
