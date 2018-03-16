<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use App\Repositories\User\EmailEqualCriteria;
use App\Repositories\User\IdEqualCriteria;
use App\Repositories\User\UserRepository;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class UserQuery extends Query
{
    protected $repository;

    protected $attributes = [
        'name' => 'Userr Query',
        'description' => 'A query of user'
    ];

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function type()
    {
        return GraphQL::type('user');
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

        if (isset($args['email'])) {
            $this->repository->pushCriteria(new EmailEqualCriteria($args['email']));
        }

        if (isset($args['id'])) {
            $this->repository->pushCriteria(new IdEqualCriteria($args['id']));
        }

        return $this->repository->with(array_keys($fields->getRelations()))->one();
    }
}