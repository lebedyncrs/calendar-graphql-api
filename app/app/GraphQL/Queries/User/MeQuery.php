<?php

namespace App\GraphQL\Queries\User;

use App\GraphQL\Auth\Authenticate;
use App\Models\User;
use App\Repositories\User\EmailEqualCriteria;
use App\Repositories\User\IdEqualCriteria;
use App\Repositories\User\UserRepository;
use App\Services\UserService;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class MeQuery extends Query
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
        'name' => 'Me Query',
        'description' => 'Return logged in user entity'
    ];

    /**
     * UserQuery constructor.
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
        return GraphQL::type('user');
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
     * @param array $args Validated arguments to filter query
     * @param SelectFields $fields
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function resolve($root, $args, SelectFields $fields)
    {
        return $this->service->getLoggedInUser();
    }
}