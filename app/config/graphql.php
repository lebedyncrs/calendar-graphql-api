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
                'newUser' => \App\GraphQL\Mutation\NewUserMutation::class
            ],
            'middleware' => []
        ],
    ],
    // register types
    'types' => [
        'user' => \App\GraphQL\Types\UserType::class,
        'calendars' => \App\GraphQL\Types\CalendarType::class,
    ],
    'error_formatter' => ['\Rebing\GraphQL\GraphQL', 'formatError'],
    'params_key' => 'params'
];
