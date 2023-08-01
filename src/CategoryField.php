<?php

namespace App;

use TheCodingMachine\GraphQLite\Annotations\Type;

#[Type]
enum CategoryField: string
{
    case ALL = '';
    case ID = 'id';
    case NAME = 'name';
}