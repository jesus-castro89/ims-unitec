<?php

use App\GraphQL\Resolver\VipResolver;

return [
    'Query' => [
        'getVips' => function ($root, $args, $context) {
            $resolver = new VipResolver();
            return $resolver->getVips($root, $args, $context);
        }
    ]
];
