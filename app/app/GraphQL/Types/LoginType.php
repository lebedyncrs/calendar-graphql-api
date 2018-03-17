<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class LoginType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Login',
        'description' => 'Login Type'
    ];

    /**
     * List of available fields in type
     * @return array
     */
    public function fields(): array
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