<?php

namespace App\GraphQL\Mutations\Event;

use App\GraphQL\Auth\Authenticate;
use App\Services\EventService;
use App\Services\UserService;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class NewEventMutation extends Mutation
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
        'name' => 'NewUser'
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
    public function type()
    {
        return GraphQL::type('event');
    }

    /**
     * List of acceptable attributes as input from client
     * @return array
     */
    public function args(): array
    {
        return [
            'title' => [
                'name' => 'title',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'string']
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string(),
                'rules' => ['string']
            ],
            'start_at' => [
                'name' => 'start_at',
                'type' => Type::string(),
                'rules' => ['date_format:"Y-m-d H:i:s"']
            ],
            'end_at' => [
                'name' => 'end_at',
                'type' => Type::string(),
                'rules' => ['date_format:"Y-m-d H:i:s"']
            ],
            'is_all_day' => [
                'name' => 'is_all_day',
                'type' => Type::boolean(),
                'rules' => ['boolean']
            ],
            'timezone' => [
                'name' => 'timezone',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'string']
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
        return $this->service->create($args);
    }
}