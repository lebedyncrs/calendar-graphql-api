<?php

namespace App\GraphQL\Mutations\User;

use App\GraphQL\Auth\Authenticate;
use App\Services\UserService;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class DeleteUserMutation extends Mutation
{
    use Authenticate;
    /**
     * @var UserService
     */
    protected $service;

    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'DeleteUser'
    ];

    /**
     * DeleteUserMutation constructor.
     * @param UserService $service
     */
    public function __construct(UserService $service)
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
                'rules' => ['required', 'integer', 'userExists']
            ]
        ];
    }

    /**
     * @param $root
     * @param array $args validated input data from client
     * @return array
     */
    public function resolve($root, $args)
    {
        return ['deleted' => $this->service->softDelete($args['id'])];
    }
}