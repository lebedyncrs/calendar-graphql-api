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
                'users' => \App\GraphQL\Queries\UsersQuery::class,
                'user' => \App\GraphQL\Queries\UserQuery::class,
            ],
            'mutation' => [
                'login' => \App\GraphQL\Mutations\LoginMutation::class,
                'newUser' => \App\GraphQL\Mutations\NewUserMutation::class,
            ],
            'middleware' => []
        ],
    ],
    // register types
    'types' => [
        'user' => \App\GraphQL\Types\UserType::class,
        'calendars' => \App\GraphQL\Types\CalendarType::class,
        'login' => \App\GraphQL\Types\LoginType::class,
    ],
    'error_formatter' => ['\App\GraphQL\GraphQL', 'formatError'],
    'params_key' => 'params'
];
