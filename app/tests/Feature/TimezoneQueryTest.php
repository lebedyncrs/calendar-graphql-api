<?php

namespace Tests\Feature;

use Tests\GraphQLTestCase;

class TimezoneQueryTest extends GraphQLTestCase
{

    public function testTimezoneListUnauthorized()
    {
        $res = $this->graphqlQuery('getTimezones');
        $res->assertJson(['errors' => [['http_code' => 401]]]);
    }

    public function testTimezoneListSuccessful()
    {
        $this->actingAsDefaultUser();
        $res = $this->graphqlQuery('getTimezones');
        $res->assertJsonStructure(['data' => ['timezones' => [['name']]]]);
        $this->assertTrue(is_string($res->json('data.timezones.0.name')));
    }
}
