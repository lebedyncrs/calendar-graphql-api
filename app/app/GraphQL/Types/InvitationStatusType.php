<?php

namespace App\GraphQL\Types;

use App\Models\EventGuest as EventGuestModel;
use App\Models\InvitationStatus;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;

class InvitationStatusType extends GraphQLType
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'InvitationStatus',
        'description' => 'InvitationStatus Type',
        'model' => InvitationStatus::class
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
                'description' => 'The id of the invitation status'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The id of the user'
            ],
            'key' => [
                'type' => Type::string(),
                'description' => 'The id of the access level '
            ]
        ];
    }
}