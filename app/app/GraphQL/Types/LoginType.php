<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class LoginType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Login',
        'description' => 'Login Type'
    ];

    public function fields()
    {
        return [
            'token' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Auth token'
            ],
            'user' => [
                'type' => GraphQL::type('user'),
                'description' => 'Authenticated user data'
            ]
        ];
    }
}