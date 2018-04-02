<?php

namespace App\GraphQL\Mutations\CalendarShare;

use App\GraphQL\Auth\Authenticate;
use App\GraphQL\Errors\PermissionDeniedError;
use App\Services\CalendarShareService;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class UpdateCalendarShareMutation extends Mutation
{
    use Authenticate;
    /**
     * @var CalendarShareService
     */
    protected $service;

    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'UpdateCalendarShare'
    ];

    /**
     * UpdateCalendarShareMutation constructor.
     * @param CalendarShareService $service
     */
    public function __construct(CalendarShareService $service)
    {
        $this->service = $service;
    }

    /**
     * Graphql type of mutation
     * @return ObjectType
     */
    public function type(): ObjectType
    {
        return GraphQL::type('calendarShare');
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
                'rules' => ['required', 'integer', 'exists:calendars_shares,id']
            ],
            'users_id' => [
                'name' => 'users_id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['integer', 'userExists']
            ],
            'access_levels_id' => [
                'name' => 'access_levels_id',
                'type' => Type::nonNull(Type::int()),
                'rules' => [ 'integer', 'exists:access_levels,id']
            ]
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
            ->with($fields->getRelations())
            ->find($args['id'], $fields->getSelect());
    }
}