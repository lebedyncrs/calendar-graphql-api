<?php

namespace Tests\Feature;

use Tests\GraphQLTestCase;

class AccessLevelsQueryTest extends GraphQLTestCase
{

    public function testAccessLevelsListUnauthorized()
    {
        $res = $this->graphqlQuery('getAccessLevels');
        $res->assertJson(['errors' => [['http_code' => 401]]]);
    }

    public function testAccessLevelsListSuccessful()
    {
        $this->actingAsDefaultUser();
        $res = $this->graphqlQuery('getAccessLevels');
        $res->assertJsonStructure(['data' => ['accessLevels' => ['data' => [['id', 'name', 'key', 'description']]]]]);
        $this->assertTrue(is_int($res->json('data.accessLevels.data.0.id')));
        $this->assertTrue(is_string($res->json('data.accessLevels.data.0.name')));
        $this->assertTrue(is_string($res->json('data.accessLevels.data.0.key')));
        $this->assertTrue(is_string($res->json('data.accessLevels.data.0.description')) || is_null($res->json('data.accessLevels.data.0.description')));
    }
}
