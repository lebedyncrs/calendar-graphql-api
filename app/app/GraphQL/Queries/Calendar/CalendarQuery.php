<?php

namespace App\GraphQL\Queries\Calendar;

use App\GraphQL\Auth\Authenticate;
use App\Repositories\Calendar\CalendarRepository;
use App\Repositories\Calendar\UsersIdEqualCriteria;
use App\Repositories\User\IdEqualCriteria;
use App\Services\CalendarService;
use GraphQL\Type\Definition\ObjectType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class CalendarQuery extends Query
{
    use Authenticate;
    /**
     * @var CalendarRepository
     */
    protected $service;
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Calendar Query',
        'description' => 'Return calendar of authenticated user'
    ];

    /**
     * CalendarQuery constructor.
     * @param CalendarService $service
     */
    public function __construct(CalendarService $service)
    {
        $this->service = $service;
    }

    /**
     * Graphql type of query
     * @return ObjectType
     */
    public function type(): ObjectType
    {
        return GraphQL::type('calendar');
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
     * @param array $args Validated arguments to filter query
     * @param SelectFields $fields
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function resolve($root, $args, SelectFields $fields)
    {
        $this->service->getRepository()->pushCriteria(new IdEqualCriteria(auth()->user()->id));

        return $this->service->getRepository()
            ->with(array_keys($fields->getRelations()))
            ->one($fields->getSelect());
    }
}