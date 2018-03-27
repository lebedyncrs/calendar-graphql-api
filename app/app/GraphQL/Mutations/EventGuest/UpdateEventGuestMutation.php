<?php

namespace App\GraphQL\Mutations\EventGuest;

use App\GraphQL\Auth\Authenticate;
use App\GraphQL\Errors\PermissionDeniedError;
use App\Repositories\EventGuest\IdEqualCriteria;
use App\Services\EventGuestService;
use App\Services\EventService;
use App\Services\UserService;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class UpdateEventGuestMutation extends Mutation
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
        'name' => 'UpdateEventGuest'
    ];

    /**
     * UpdateEventGuestMutation constructor.
     * @param EventGuestService $service
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
        return GraphQL::type('eventGuest');
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
                'rules' => ['required', 'integer', 'exists:events_guests,id']
            ],
            'events_id' => [
                'name' => 'events_id',
                'type' => Type::int(),
                'rules' => ['integer', 'exists:events,id']
            ],
            'users_id' => [
                'name' => 'users_id',
                'type' => Type::int(),
                'rules' => ['integer', 'userExists']
            ],
            'access_levels_id' => [
                'name' => 'access_levels_id',
                'type' => Type::int(),
                'rules' => ['integer', 'exists:access_levels,id']
            ],
            'invitation_statuses_id' => [
                'name' => 'invitation_statuses_id',
                'type' => Type::int(),
                'rules' => ['integer', 'exists:invitation_statuses,id']
            ],
        ];
    }

    /**
     * @param $root
     * @param array $args validated input data from client
     * @param SelectFields $fields
     * @return object
     * @throws PermissionDeniedError
     */
    public function resolve($root, $args, SelectFields $fields): object
    {
        if (!$this->service->hasPermissionToUpdate($args['id'], auth()->user()->id)) {
            throw new PermissionDeniedError();
        }

        $this->service->update($args);

        return $this->service
            ->getRepository()
            ->pushCriteria(new IdEqualCriteria($args['id']))
            ->with($fields->getRelations())
            ->one($fields->getSelect());
    }
}