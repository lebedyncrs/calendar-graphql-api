<?php

namespace App\GraphQL\Types;

use App\GraphQL\Types\EventGuest as EventGuestModel;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class EventGuest extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'EventGuest',
        'description' => 'EventGuest Type',
        'model' => EventGuestModel::class
    ];

    /**
     * List of available fields in type
     * @return array
     */
    public function fields(): array
    {
        return [
            'events_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the event'
            ],
            'users_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the user'
            ],
            'access_levels_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the access level '
            ],
            'invitation_statuses_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the invitation status'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The created time of EventGuest'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The updated time of EventGuest'
            ]
        ];
    }
}