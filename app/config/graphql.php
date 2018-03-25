<?php

return [
    'prefix' => 'api/graphql',
    'routes' => 'query/{graphql_schema?}',
    'controllers' => \Rebing\GraphQL\GraphQLController::class . '@query',
    'middleware' => [],
    'default_schema' => 'default',
    // register query
    'schemas' => [
        'default' => [
            'query' => [
                'users' => \App\GraphQL\Queries\User\UsersQuery::class,
                'user' => \App\GraphQL\Queries\User\UserQuery::class,
                'sharedCalendars' => \App\GraphQL\Queries\Calendar\SharedCalendarsQuery::class,
                'calendar' => \App\GraphQL\Queries\Calendar\CalendarQuery::class,
                'events' => \App\GraphQL\Queries\Event\EventsQuery::class,
                'timezones' => \App\GraphQL\Queries\Timezone\TimezonesQuery::class,
                'accessLevels' => \App\GraphQL\Queries\AccessLevel\AccessLevelsQuery::class,
            ],
            'mutation' => [
                // user
                'login' => \App\GraphQL\Mutations\Auth\LoginMutation::class,
                'newUser' => \App\GraphQL\Mutations\User\NewUserMutation::class,
                'updateUser' => \App\GraphQL\Mutations\User\UpdateUserMutation::class,
                'deleteUser' => \App\GraphQL\Mutations\User\DeleteUserMutation::class,
                // event
                'newEvent' => \App\GraphQL\Mutations\Event\NewEventMutation::class,
                'updateEvent' => \App\GraphQL\Mutations\Event\UpdateEventMutation::class,
                'deleteEvent' => \App\GraphQL\Mutations\Event\DeleteEventMutation::class,
                // event guest
                'newEventGuest' => \App\GraphQL\Mutations\EventGuest\NewEventGuestMutation::class,
                'updateEventGuest' => \App\GraphQL\Mutations\EventGuest\UpdateEventGuestMutation::class,
                'deleteEventGuest' => \App\GraphQL\Mutations\EventGuest\DeleteEventGuestMutation::class,
            ],
            'middleware' => []
        ],
    ],
    // register types
    'types' => [
        'user' => \App\GraphQL\Types\UserType::class,
        'calendar' => \App\GraphQL\Types\CalendarType::class,
        'login' => \App\GraphQL\Types\LoginType::class,
        'delete' => \App\GraphQL\Types\DeleteType::class,
        'event' => \App\GraphQL\Types\EventType::class,
        'timezone' => \App\GraphQL\Types\TimezoneType::class,
        'accessLevel' => \App\GraphQL\Types\AccessLevel::class,
        'eventGuest' => \App\GraphQL\Types\EventGuestType::class,
        'invitationStatus' => \App\GraphQL\Types\InvitationStatusType::class,
    ],
    'error_formatter' => ['\App\GraphQL\GraphQL', 'formatError'],
    'params_key' => 'params'
];
