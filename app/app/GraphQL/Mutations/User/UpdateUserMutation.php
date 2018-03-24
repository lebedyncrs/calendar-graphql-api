<?php

namespace App\GraphQL\Mutations\User;

use App\GraphQL\Auth\Authenticate;
use App\GraphQL\Errors\PermissionDeniedError;
use App\Models\User;
use App\Services\UserService;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class UpdateUserMutation extends Mutation
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
        'name' => 'UpdateUser'
    ];

    /**
     * NewUserMutation constructor.
     * @param UserService $repository
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
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required', 'integer']
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
                'rules' => ['string']
            ],
            'surname' => [
                'name' => 'surname',
                'type' => Type::string(),
                'rules' => ['string']
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::string(),
                'rules' => ['string']
            ],
            'timezone' => [
                'name' => 'timezone',
                'type' => Type::string(),
                'rules' => ['string']
            ]
        ];
    }

    /**
     * @param $root
     * @param array $args validated input data from client
     * @param SelectFields $fields
     * @return array
     */
    public function resolve($root, $args, SelectFields $fields): User
    {
        if ($args['id'] != auth()->user()->id) {
            throw new PermissionDeniedError();
        }

        $this->service->update($args);

        return $this->service
            ->getRepository()
            ->with($fields->getRelations())
            ->find($args['id'], $fields->getSelect());
    }
}