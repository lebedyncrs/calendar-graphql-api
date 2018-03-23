<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class DeleteType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Delete',
        'description' => 'Delete Type'
    ];

    /**
     * List of available fields in type
     * @return array
     */
    public function fields(): array
    {
        return [
            'deleted' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'Confirmation attribute'
            ]
        ];
    }
}