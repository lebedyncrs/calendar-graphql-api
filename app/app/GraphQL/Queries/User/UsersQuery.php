<?php

namespace App\GraphQL\Queries\User;

use App\GraphQL\Auth\Authenticate;
use App\Repositories\User\UserRepository;
use App\Services\UserService;
use GraphQL\Type\Definition\ObjectType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class UsersQuery extends Query
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
        'name' => 'Users Query',
        'description' => 'A query of users'
    ];

    /**
     * UsersQuery constructor.
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Graphql type of query
     * @return ObjectType
     */
    public function type(): ObjectType
    {
        return GraphQL::paginate('user');
    }

    /**
     * Arguments to filter query
     * @return array
     */
    public function args(): array
    {
        return [];
    }

    /**
     * @param $root
     * @param $args Validated aguments to filter query
     * @param SelectFields $fields
     * @return mixed
     */
    public function resolve($root, $args, SelectFields $fields)
    {
        return $this->service->getRepository()
            ->with(array_keys($fields->getRelations()))
            ->paginate(25, $fields->getSelect());
    }
}