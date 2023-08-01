<?php

namespace App\GraphQL\Controllers;

use App\Category;
use App\CategoryQuery;
use App\Client;
use App\ClientQuery;
use TheCodingMachine\GraphQLite\Annotations\Query;
use TheCodingMachine\GraphQLite\Types\ID;

class ClientController
{

    private ClientQuery $query;

    public function __construct()
    {
        $this->query = new ClientQuery();
    }

    #[Query]
    public function clientById(string $id): Client
    {
        return $this->query->findOneById($id);
    }


}