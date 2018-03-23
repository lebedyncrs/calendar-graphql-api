<?php

namespace App\GraphQL\Queries\User;

use App\GraphQL\Auth\Authenticate;
use App\Models\User;
use App\Repositories\User\EmailEqualCriteria;
use App\Repositories\User\IdEqualCriteria;
use App\Repositories\User\UserRepository;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class UserQuery extends Query
{
    use Authenticate;
    /**
     * @var UserRepository
     */
    protected $repository;
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Userr Query',
        'description' => 'A query of user'
    ];

    /**
     * UserQuery constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Graphql type of query
     * @return ObjectType
     */
    public function type()
    {
        return GraphQL::type('user');
    }

    /**
     * Arguments to filter query
     * @return array
     */
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

    /**
     * @param $root
     * @param array $args Validated aguments to filter query
     * @param SelectFields $fields
     * @return \Illuminate\Database\Eloquent\Model
     */
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