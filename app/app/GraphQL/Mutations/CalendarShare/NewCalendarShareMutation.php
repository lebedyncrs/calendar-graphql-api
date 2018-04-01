<?php

namespace App\GraphQL\Mutations\CalendarShare;

use App\GraphQL\Auth\Authenticate;
use App\Services\CalendarShareService;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class NewCalendarShareMutation extends Mutation
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
        'name' => 'NewCalendarShare',
        'description' => 'Mutation to share own calendar with other users. Only own calendar can be shared with others'
    ];

    /**
     * NewCalendarShareMutation constructor.
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
            'users_id' => [
                'name' => 'users_id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required', 'integer', 'userExists']
            ],
            'access_levels_id' => [
                'name' => 'access_levels_id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required', 'integer', 'exists:access_levels,id']
            ]
        ];
    }

    /**
     * @param $root
     * @param array $args validated input data from client
     * @return array
     */
    public function resolve($root, $args, SelectFields $fields): array
    {
        $model = $this->service->create($args);
        $model->load($fields->getRelations());
        return $model->toArray();
    }
}