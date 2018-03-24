<?php

namespace App\GraphQL\Mutations\Event;

use App\GraphQL\Auth\Authenticate;
use App\GraphQL\Errors\PermissionDeniedError;
use App\Services\EventService;
use App\Services\UserService;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class DeleteEventMutation extends Mutation
{
    use Authenticate;
    /**
     * @var EventService
     */
    protected $service;

    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'DeleteEvent'
    ];

    /**
     * NewEventMutation constructor.
     * @param EventService $repository
     */
    public function __construct(EventService $repository)
    {
        $this->service = $repository;
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
                'rules' => ['required', 'integer', 'eventExists']
            ]
        ];
    }

    /**
     * @param $root
     * @param array $args validated input data from client
     * @return array
     * @throws PermissionDeniedError
     */
    public function resolve($root, $args): array
    {
        if (!$this->service->hasPermissionToUpdate($args['id'], auth()->user()->id)) {
            throw new PermissionDeniedError();
        }


        return ['deleted' => $this->service->softDelete($args['id'])];
    }
}