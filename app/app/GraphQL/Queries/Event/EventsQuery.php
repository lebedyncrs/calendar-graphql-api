<?php

namespace App\GraphQL\Queries\Event;

use App\GraphQL\Auth\Authenticate;
use App\Services\EventService;
use GraphQL\Type\Definition\ObjectType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class EventsQuery extends Query
{
    use Authenticate;
    /**
     * @var EventService
     */
    protected $service;
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Events Query',
        'description' => 'Event list of authenticated user'
    ];

    /**
     * EventsQuery constructor.
     * @param EventService $service
     */
    public function __construct(EventService $service)
    {
        $this->service = $service;
    }

    /**
     * Graphql type of query
     * @return ObjectType
     */
    public function type(): ObjectType
    {
        return GraphQL::paginate('event');
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
     * @param $args Validated arguments to filter query
     * @param SelectFields $fields
     * @return mixed
     */
    public function resolve($root, $args, SelectFields $fields)
    {
        return $this->service->getRepository()
            ->with($fields->getRelations())
            ->paginate(25, $fields->getSelect());
    }
}