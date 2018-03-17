<?php

namespace App\GraphQL\Mutations;

use App\Services\UserService;
use GraphQL\Type\Definition\Type;
use Illuminate\Auth\AuthenticationException;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\GraphQL\Errors\AuthorizationError;

class LoginMutation extends Mutation
{
    protected $service;

    protected $attributes = [
        'name' => 'Login',
        'description' => 'Log the user in by email',
    ];

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function type()
    {
        return GraphQL::type('login');
    }

    public function args()
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

    public function resolve($root, $args)
    {
        try {
            $login = $this->service->login($args['email'], $args['password']);
        } catch (AuthenticationException $e) {
            throw new AuthorizationError();
        }

        return $login;
    }

}