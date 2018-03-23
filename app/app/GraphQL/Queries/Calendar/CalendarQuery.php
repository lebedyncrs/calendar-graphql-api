<?php

namespace App\GraphQL\Queries\Calendar;

use App\GraphQL\Auth\Authenticate;
use App\Repositories\Calendar\CalendarRepository;
use App\Repositories\Calendar\UsersIdEqualCriteria;
use App\Repositories\User\IdEqualCriteria;
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
    protected $repository;
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Calendar Query',
        'description' => 'Return calendar of authenticated user'
    ];

    /**
     * CalendarQuery constructor.
     * @param CalendarRepository $repository
     */
    public function __construct(CalendarRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Graphql type of query
     * @return ObjectType
     */
    public function type()
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
        $this->repository->pushCriteria(new IdEqualCriteria(auth()->user()->id));

//        var_export($fields->getRelations());
//        exit;
        return $this->repository
            ->with(array_keys($fields->getRelations()))
            ->one($fields->getSelect());
    }
}