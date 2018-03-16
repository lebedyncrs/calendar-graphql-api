<?php

namespace App\GraphQL\Types;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Users',
        'description' => 'User Type',
        'model' => User::class,
    ];

    // define field of type
    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the user'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the user'
            ],
            'surname' => [
                'type' => Type::string(),
                'description' => 'The name of the user'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of user'
            ],
            'timezone' => [
                'type' => Type::string(),
                'description' => 'The timezone of the user'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The created at timestamp of the user'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The updated at timestamp of the user'
            ],
            'calendars' => [
                'type' => Type::listOf(GraphQL::type('calendars')),
                'description' => 'The calendars of the user'
            ]
        ];
    }
}