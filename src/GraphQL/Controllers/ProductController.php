<?php

namespace App\GraphQL\Controllers;

use App\Product;
use App\ProductField;
use App\ProductQuery;
use TheCodingMachine\GraphQLite\Annotations\Mutation;

class ProductController
{
    private ProductQuery $query;

    public function __construct()
    {
        $this->query = new ProductQuery();
    }

    /**
     * @param ProductField|null $field
     * @param string|null $search
     * @return Product[]
     */
    #[Mutation]
    public function product(?ProductField $field = ProductField::ALL, ?string $search = ""): array
    {
        switch ($field) {
            case ProductField::ALL:
            {
                $result = $this->query->find();
                foreach ($result as $item) {
                    $output[] = $item;
                }
            }
            case ProductField::ID:
            {
                $result = $this->query->filterById($search)->find();
                foreach ($result as $item) {
                    $output[] = $item;
                }
            }
            case ProductField::NAME:
                {
                    $result = $this->query->filterByName($search)->find();
                    foreach ($result as $item) {
                        $output[] = $item;
                    }
                }
                break;
            case ProductField::PRICE:
            {
                $result = $this->query->filterByPrice($search)->find();
                foreach ($result as $item) {
                    $output[] = $item;
                }
            }
            case ProductField::CATEGORY:
            {
                $result = $this->query->filterByCategoryId($search)->find();
                foreach ($result as $item) {
                    $output[] = $item;
                }
            }

        }
        return !empty($output) ? $output : [];
    }
}