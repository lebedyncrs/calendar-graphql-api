<?php

namespace Tests\Feature\GraphQL\Queries\Timezone;

use Tests\GraphQLTestCase;

class TimezoneQueryTest extends GraphQLTestCase
{
    public function testTimezoneListUnauthorized()
    {
        $res = $this->graphqlQuery('timezones', [], ['name']);
        $res->assertUnAuthorized();
    }

    public function testTimezoneListSuccessful()
    {
        $this->actingAsDefaultUser();
        $res = $this->graphqlQuery('timezones', [], ['name']);
        $res->assertJsonStructure(['data' => ['timezones' => [['name']]]]);
        $res->assertKeyIsString('data.timezones.0.name');
    }
}
