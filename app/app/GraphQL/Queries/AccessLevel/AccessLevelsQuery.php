<?php

namespace App\GraphQL\Queries\AccessLevel;

use App\GraphQL\Auth\Authenticate;
use App\Repositories\AccessLevel\AccessLevelRepository;
use GraphQL\Type\Definition\ObjectType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class AccessLevelsQuery extends Query
{
    use Authenticate;
    /**
     * @var AccessLevelRepository
     */
    protected $repository;
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Access Levels Query',
        'description' => 'List of access levels for events and calendars'
    ];

    /**
     * AccessLevelsQuery constructor.
     * @param AccessLevelRepository $repository
     */
    public function __construct(AccessLevelRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Graphql type of query
     * @return ObjectType
     */
    public function type(): ObjectType
    {
        return GraphQL::paginate('accessLevel');
    }

    /**
     * Arguments to filter query
     * @return array
     */
    public function args()
    {
        return [];
    }

    /**
     * @param $root
     * @param $args Validated arguments to filter query
     * @param SelectFields $fields
     * @return mixed
     */
    public function resolve($root, $args, SelectFields $fields)
    {
        return $this->repository
            ->with(array_keys($fields->getRelations()))
            ->paginate(25, $fields->getSelect());
    }
}