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
        $res = $this->graphqlQuery(
            'me',
            [],
            ['id', 'name', 'surname', 'email', 'timezone', 'created_at', 'updated_at']
        );
        $res->assertKeysHaveTypes(
            'data.me',
            [
                'id' => 'int', 'name' => 'string', 'surname' => 'string', 'email' => 'string',
                'timezone' => 'string', 'created_at' => 'string', 'updated_at' => 'string'
            ]
        );

        $res = $this->graphqlQuery(
            'me',
            [],
            ['id']
        );
        $res->assertKeysHaveTypes(
            'data.me',
            ['id' => 'int']
        );
    }
}
