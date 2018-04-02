<?php

namespace Tests\Feature;

use Tests\GraphQLTestCase;

class AuthTest extends GraphQLTestCase
{
    public function testLogIn()
    {
        $res = $this->graphqlMutation('logIn', ['email' => 'john.smith@gmail.com', 'password' => 'default-pass']);
        $res->assertJsonStructure(['data' => ['login' => ['token']]]);

        $res = $this->graphqlMutation('logIn', ['email' => 'jo1hn.smith@gmail.com', 'password' => 'default-pass']);
        $res->assertJson(['errors' => [['http_code' => 401]]]);
    }
}
