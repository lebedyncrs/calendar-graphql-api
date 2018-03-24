<?php

namespace App\GraphQL\Queries\Calendar;

use App\GraphQL\Auth\Authenticate;
use App\Repositories\Calendar\CalendarRepository;
use App\Repositories\Calendar\IdInCriteria;
use App\Repositories\CalendarShare\CalendarShareRepository;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class SharedCalendarsQuery extends Query
{
    use Authenticate;
    /**
     * @var CalendarShareRepository
     */
    protected $calendarShareRepository;
    /**
     * @var CalendarRepository
     */
    protected $calendarRepository;
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Calendars Query',
        'description' => 'Shared calendars of authenticated user are included in response'
    ];

    /**
     * CalendarsQuery constructor.
     * @param CalendarShareRepository $calendarShareRepository
     * @param CalendarRepository $calendarRepository
     */
    public function __construct(CalendarRepository $calendarRepository, CalendarShareRepository $calendarShareRepository)
    {
        $this->calendarRepository = $calendarRepository;
        $this->calendarShareRepository = $calendarShareRepository;
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
        $ids = $this->calendarShareRepository->getIdsByUser(auth()->user()->id);

        return $this->calendarRepository
            ->pushCriteria(new IdInCriteria($ids))
            ->with(array_keys($fields->getRelations()))
            ->paginate(25, $fields->getSelect());
    }
}