<?php

namespace Tests\Feature\GraphQL\Mutations\Auth;

use Tests\GraphQLTestCase;

class LoginMutation extends GraphQLTestCase
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
