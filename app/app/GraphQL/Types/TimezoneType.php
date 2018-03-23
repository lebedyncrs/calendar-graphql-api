<?php

namespace App\GraphQL\Types;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class TimezoneType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Timezone',
        'description' => 'Timezone Type'
    ];

    /**
     * List of available fields in type
     * @return array
     */
    public function fields(): array
    {
        return [
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of timezone'
            ]
        ];
    }
}