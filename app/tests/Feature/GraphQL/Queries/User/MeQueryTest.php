<?php

namespace Tests\Feature\GraphQL\Queries\User;

use Tests\GraphQLTestCase;

class MeQueryTest extends GraphQLTestCase
{
    public function testGetMeUnauthorized()
    {
        $res = $this->graphqlQuery('me', [], ['id']);
        $res->assertUnAuthorized();
    }

    public function testGetMeListSuccessful()
    {
        $this->actingAsDefaultUser();
        $res = $this->graphqlQuery('me', [], ['id', 'name', 'surname']);
        $res->assertJsonStructure(['data' => ['me' => ['id', 'name', 'surname']]]);
        $res->assertKeyIsInt('data.me.id');
        $res->assertKeyIsString('data.me.name');
        $res->assertKeyIsString('data.me.surname');
    }
}
