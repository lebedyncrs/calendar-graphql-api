<?php

namespace Tests\Feature\GraphQL\Queries\AccessLevel;

use App\Models\User;
use Tests\GraphQLTestCase;

class AccessLevelsQueryTest extends GraphQLTestCase
{
    public function testAccessLevelsListUnauthorized()
    {
        $res = $this->graphqlQuery('accessLevels', [], ['data' => ['id']]);
        $res->assertUnAuthorized();
    }

    public function testAccessLevelsListSuccessful()
    {
        $this->actingAsDefaultUser();
        $res = $this->graphqlQuery('accessLevels', [], ['data' => ['id', 'name', 'key', 'description']]);
        $res->assertJsonStructure(['data' => ['accessLevels' => ['data' => [['id', 'name', 'key', 'description']]]]]);
        $res->assertKeysHaveTypes(
            'data.accessLevels.data.0',
            ['id' => 'int', 'name' => 'string', 'key' => 'string', 'description' => '?string']
        );
    }
}
