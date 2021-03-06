<?php

namespace App\GraphQL\Mutations\User;

use App\GraphQL\Auth\Authenticate;
use App\Services\UserService;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class NewUserMutation extends Mutation
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
        'name' => 'NewUser'
    ];

    /**
     * NewUserMutation constructor.
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
        return GraphQL::type('user');
    }

    /**
     * List of acceptable attributes as input from client
     * @return array
     */
    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'string']
            ],
            'surname' => [
                'name' => 'surname',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'string']
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'email', 'unique:users,email']
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'string']
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