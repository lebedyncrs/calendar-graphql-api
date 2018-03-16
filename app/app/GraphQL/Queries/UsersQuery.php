<?php

namespace App\GraphQL\Queries;

use App\Repositories\User\UserRepository;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class UsersQuery extends Query
{
    /**
     * @var UserRepository
     */
    protected $repository;
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Users Query',
        'description' => 'A query of users'
    ];

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function type()
    {
        return GraphQL::paginate('user');
    }

    // arguments to filter query
    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string()
            ],
            'surname' => [
                'name' => 'surname',
                'type' => Type::string()
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string()
            ],
            'timezone' => [
                'name' => 'timezone',
                'type' => Type::string()
            ],
            'created_at' => [
                'name' => 'created_at',
                'type' => Type::string()
            ],
            'updated_at' => [
                'name' => 'updated_at',
                'type' => Type::string()
            ],
        ];
    }

    public function resolve($root, $args, SelectFields $fields)
    {
        return $this->repository
            ->with(array_keys($fields->getRelations()))
            ->paginate(25, $fields->getSelect());

    }
}