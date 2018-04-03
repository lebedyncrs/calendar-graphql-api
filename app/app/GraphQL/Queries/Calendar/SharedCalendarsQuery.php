<?php

namespace App\GraphQL\Queries\Calendar;

use App\GraphQL\Auth\Authenticate;
use App\Repositories\Calendar\CalendarRepository;
use App\Repositories\Calendar\IdInCriteria;
use App\Repositories\CalendarShare\CalendarShareRepository;
use App\Services\CalendarShareService;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class SharedCalendarsQuery extends Query
{
    use Authenticate;
    /**
     * @var CalendarShareService
     */
    protected $service;
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Calendars Query',
        'description' => 'Shared calendars of authenticated user are included in response'
    ];

    /**
     * SharedCalendarsQuery constructor.
     * @param CalendarShareService $calendarShareService
     */
    public function __construct(CalendarShareService $calendarShareService)
    {
        $this->service = $calendarShareService;
    }

    /**
     * Graphql type of query
     * @return ObjectType
     */
    public function type(): ObjectType
    {
        return GraphQL::paginate('calendar');
    }

    /**
     * Arguments to filter query
     * @return array
     */
    public function args(): array
    {
        return [
            'owner_id' => [
                'name' => 'name',
                'type' => Type::int()
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
        $ids = $this->service->getRepository()->getIdsByUser(auth()->user()->id);

        return $this->service->getCalendarRepository()
            ->pushCriteria(new IdInCriteria($ids))
            ->with(array_keys($fields->getRelations()))
            ->paginate(25, $fields->getSelect());
    }
}