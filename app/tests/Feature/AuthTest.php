<?php

namespace Tests\Feature;

use Tests\GraphQLTestCase;

class AuthTest extends GraphQLTestCase
{
    public function testLogInFailed()
    {
        $res = $this->graphqlMutation('logIn', ['email' => 'jo1hn.smith@gmail.com', 'password' => 'default-pass']);
        $res->assertJson(['errors' => [['http_code' => 401]]]);
    }

    public function testLogInSuccessfully()
    {
        $res = $this->graphqlMutation('logIn', ['email' => 'john.smith@gmail.com', 'password' => 'default-pass']);
        $res->assertJsonStructure(['data' => ['login' => ['token']]]);
    }
}
