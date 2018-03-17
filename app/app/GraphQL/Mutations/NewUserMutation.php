<?php

namespace App\GraphQL\Mutations;

use App\Repositories\User\UserRepository;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class NewUserMutation extends Mutation
{
    protected $repository;

    protected $attributes = [
        'name' => 'NewUser'
    ];

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function type()
    {
        return GraphQL::type('user');
    }

    public function args()
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ],
            'surname' => [
                'name' => 'surname',
                'type' => Type::nonNull(Type::string())
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string())
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string())
            ],
            'timezone' => [
                'name' => 'timezone',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    public function rules(array $args = [])
    {
        return [
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string'],
            'timezone' => ['required', 'string'],
        ];
    }

    public function resolve($root, $args)
    {
        $args['password'] = bcrypt($args['password']);
        $user = $this->repository->create($args);
        if (!$user) {
            return null;
        }
        return $user;
    }
}