<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use App\Models\AccessLevel as AccessLevelModel;
use Rebing\GraphQL\Support\Type as GraphQLType;

class AccessLevel extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'AccessLevel',
        'description' => 'AccessLevel Type',
        'model' => AccessLevelModel::class
    ];

    /**
     * List of available fields in type
     * @return array
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the access level'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of the access level'
            ],
            'key' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The key of the access level '
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'The description of the access level'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The created time of access level'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The updated time of access level'
            ]
        ];
    }
}