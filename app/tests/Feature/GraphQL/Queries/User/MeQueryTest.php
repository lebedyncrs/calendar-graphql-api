<?php

namespace Tests\Feature\GraphQL\Queries\User;

use Tests\GraphQLTestCase;

class MeQueryTest extends GraphQLTestCase
{
    public function testGetMeUnauthorized()
    {
        $res = $this->graphqlQuery('getMe');
        $res->assertJson(['errors' => [['http_code' => 401]]]);
    }

    public function testGetMeListSuccessful()
    {
        $this->actingAsDefaultUser();
        $res = $this->graphqlQuery('getMe', [], ['id', 'name', 'surname']);
        $res->assertJsonStructure(['data' => ['me' => ['id', 'name', 'surname']]]);
        $this->assertTrue(is_int($res->json('data.me.id')));
        $this->assertTrue(is_string($res->json('data.me.name')));
        $this->assertTrue(is_string($res->json('data.me.surname')));
    }
}
