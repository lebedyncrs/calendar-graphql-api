<?php

namespace App\GraphQL\Mutations\EventGuest;

use App\GraphQL\Auth\Authenticate;
use App\Services\EventGuestService;
use App\Services\EventService;
use App\Services\UserService;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class NewEventGuestMutation extends Mutation
{
    use Authenticate;
    /**
     * @var EventGuestService
     */
    protected $service;

    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'NewEventGuest'
    ];

    /**
     * NewEventGuestMutation constructor.
     * @param EventGuestService $repository
     */
    public function __construct(EventGuestService $repository)
    {
        $this->service = $repository;
    }

    /**
     * Graphql type of mutation
     * @return ObjectType
     */
    public function type(): ObjectType
    {
        return GraphQL::type('eventGuest');
    }

    /**
     * List of acceptable attributes as input from client
     * @return array
     */
    public function args(): array
    {
        return [
            'events_id' => [
                'name' => 'events_id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required', 'integer', 'exists:events,id']
            ],
            'users_id' => [
                'name' => 'users_id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required', 'integer', 'userExists']
            ],
            'access_levels_id' => [
                'name' => 'access_levels_id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required', 'integer', 'exists:access_levels,id']
            ],
            'invitation_statuses_id' => [
                'name' => 'invitation_statuses_id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required', 'integer', 'exists:invitation_statuses,id']
            ],
        ];
    }

    /**
     * @param $root
     * @param array $args validated input data from client
     * @return array
     */
    public function resolve($root, $args): array
    {
        return $this->service->create($args);
    }
}