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

class UserQuery extends Query
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
        'name' => 'User Query',
        'description' => 'A query of user'
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
            ]
        ];
    }

    /**
     * @param $root
     * @param array $args Validated arguments to filter query
     * @param SelectFields $fields
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function resolve($root, $args, SelectFields $fields)
    {
        $repository = $this->service->getRepository();
        if (isset($args['email'])) {
            $repository->pushCriteria(new EmailEqualCriteria($args['email']));
        }

        if (isset($args['id'])) {
            $repository->pushCriteria(new IdEqualCriteria($args['id']));
        }

        return $repository->with(array_keys($fields->getRelations()))->one();
    }
}