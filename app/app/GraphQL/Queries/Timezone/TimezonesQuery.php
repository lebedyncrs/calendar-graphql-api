<?php

namespace App\GraphQL\Queries\Timezone;

use App\GraphQL\Auth\Authenticate;
use GraphQL\Type\Definition\ListOfType;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\Type;

class TimezonesQuery extends Query
{
    use Authenticate;
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'Timezones Query',
        'description' => 'list supported timezones'
    ];

    /**
     * Graphql type of query
     * @return ListOfType
     */
    public function type(): ListOfType
    {
        return Type::listOf(GraphQL::type('timezone'));
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
     * @return mixed
     */
    public function resolve($root, $args)
    {
        return array_map(function ($item) {
            return ['name' => $item];
        }, timezone_identifiers_list());
    }

}