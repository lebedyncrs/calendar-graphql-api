<?php

namespace App\GraphQL\Types;

use App\Models\Calendar;
use App\Models\Event;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;

class EventType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Event',
        'description' => 'Event Type',
        'model' => Event::class
    ];

    /**
     * List of available fields in Event type
     * @return array
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of event'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'The title of event'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'The description of event'
            ],
            'start_at' => [
                'type' => Type::string(),
                'description' => 'The start time of event'
            ],
            'end_at' => [
                'type' => Type::string(),
                'description' => 'The end time of event'
            ],
            'is_all_day' => [
                'type' => Type::boolean(),
                'description' => 'Flag shows if event takes all day'
            ],
            'timezone' => [
                'type' => Type::string(),
                'description' => 'The timezone of event'
            ],
            'owner_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The owner id of event'
            ],
            'parent_id' => [
                'type' => Type::int(),
                'description' => 'The parent event id'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The created time of event'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The updated time of event'
            ],
            'deleted_at' => [
                'type' => Type::string(),
                'description' => 'The deleted time of event'
            ],
            'owner' => [
                'type' => GraphQL::type('user'),
                'description' => 'owner of calendar'
            ],
        ];
    }
}