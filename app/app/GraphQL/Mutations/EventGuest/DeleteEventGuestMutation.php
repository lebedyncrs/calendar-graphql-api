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

class DeleteEventGuestMutation extends Mutation
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
        'name' => 'DeleteEventGuest'
    ];

    /**
     * DeleteEventGuestMutation constructor.
     * @param EventGuestService $repository
     */
    public function __construct(EventGuestService $service)
    {
        $this->service = $service;
    }

    /**
     * Graphql type of mutation
     * @return ObjectType
     */
    public function type(): ObjectType
    {
        return GraphQL::type('delete');
    }

    /**
     * List of acceptable attributes as input from client
     * @return array
     */
    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required', 'integer', 'exists:events_guests']
            ]
        ];
    }

    /**
     * @param $root
     * @param array $args validated input data from client
     * @return array
     */
    public function resolve($root, $args): array
    {
        return $this->service->softDelete($args['id']);
    }
}