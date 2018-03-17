<?php

namespace App\GraphQL\Mutations\Auth;

use App\Services\UserService;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Illuminate\Auth\AuthenticationException;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\GraphQL\Errors\AuthorizationError;

class LoginMutation extends Mutation
{
    /**
     * @var UserService
     */
    protected $service;

    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Login',
        'description' => 'Log the user in by email',
    ];

    /**
     * LoginMutation constructor.
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
    public function type()
    {
        return GraphQL::type('login');
    }

    /**
     * List of acceptable attributes as input from client
     * @return array
     */
    public function args(): array
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'email'],
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'string'],
            ],
        ];
    }

    /**
     * @param $root
     * @param array $args validated input data from client
     * @return array
     * @throws AuthorizationError
     */
    public function resolve($root, $args): array
    {
        try {
            $login = $this->service->login($args['email'], $args['password']);
        } catch (AuthenticationException $e) {
            throw new AuthorizationError();
        }

        return $login;
    }

}