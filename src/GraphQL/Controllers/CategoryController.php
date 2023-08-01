<?php

namespace App\GraphQL\Controllers;

use App\Category;
use App\CategoryField;
use App\CategoryQuery;
use TheCodingMachine\GraphQLite\Annotations\Mutation;
use TheCodingMachine\GraphQLite\Annotations\Query;

class CategoryController
{

    private CategoryQuery $query;

    public function __construct()
    {
        $this->query = new CategoryQuery();
    }

    /**
     * @return Category[] <=== Regresa un arreglo de objetos de tipo Category de acuerdo a un campo y datos especificados.
     */
    #[Mutation]
    public function category(?CategoryField $field = CategoryField::ALL, ?string $search = ""): array
    {
        $output = [];
        $result = null;
        switch ($field) {
            case CategoryField::ALL:
            {
                $result = $this->query->find();
                foreach ($result as $item) {
                    $output[] = $item;
                }
            }
            case CategoryField::ID:
            {
                $result = $this->query->filterById($search)->find();
                foreach ($result as $item) {
                    $output[] = $item;
                }
            }
            case CategoryField::NAME:
            {
                $result = $this->query->filterByName($search)->find();
                foreach ($result as $item) {
                    $output[] = $item;
                }
            }
        }
        return $output;
    }
}