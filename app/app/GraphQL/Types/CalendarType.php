<?php

namespace App\GraphQL\Types;

use App\Models\Calendar;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CalendarType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Calendar',
        'description' => 'Calendar Type',
        'model' => Calendar::class,
    ];

    /**
     * List of available fields in Calendar type
     * @return array
     */
    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the calendar'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the calendar'
            ],
            'color' => [
                'type' => Type::string(),
                'description' => 'The color of the calendar'
            ],
            'owner_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The owner id of calendar'
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The created at timestamp of the calendar'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The updated at timestamp of the calendar'
            ],
        ];
    }
}