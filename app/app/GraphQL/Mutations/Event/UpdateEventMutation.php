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

class UpdateEventMutation extends Mutation
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
        'name' => 'UpdatedEvent'
    ];

    /**
     * UpdateEventMutation constructor.
     * @param EventService $service
     */
    public function __construct(EventService $service)
    {
        $this->service = $service;
    }

    /**
     * Graphql type of mutation
     * @return ObjectType
     */
    public function type(): ObjectType
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
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required', 'integer']
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::string(),
                'rules' => ['string']
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
                'type' => Type::string(),
                'rules' => ['string']
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