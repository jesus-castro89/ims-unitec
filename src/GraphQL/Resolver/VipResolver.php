<?php

namespace App\GraphQL\Resolver;

use App\VipQuery;
use Propel\Runtime\Map\TableMap;

class VipResolver
{
    private $query;

    public function __construct()
    {
        $this->query = new VipQuery();
    }

    public function getVips($root, $args, $context)
    {
        $result = $this->query->find();
        $output = [];
        foreach ($result as $item) {

            $output[] = $item->toArray(TableMap::TYPE_CAMELNAME);
        }
        return $output;
    }
}
