<?php

namespace App\GraphQL\Types;

use App\Models\CalendarShare;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CalendarShareType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'CalendarShare',
        'description' => 'CalendarShare Type',
        'model' => CalendarShare::class
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
                'description' => 'The id of shared calendar'
            ],
            'calendars_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of shared calendar'
            ],
            'users_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The user id calendar shared with'
            ],
            'access_levels_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of access level to shared calendar'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The time when calendar shared'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The last time when calendar share updated'
            ],
            'user' => [
                'type' => GraphQL::type('user'),
                'description' => 'user of calendar shared with'
            ],
            'calendar' => [
                'type' => GraphQL::type('calendar'),
                'description' => 'calendar shared with user'
            ],
        ];
    }
}