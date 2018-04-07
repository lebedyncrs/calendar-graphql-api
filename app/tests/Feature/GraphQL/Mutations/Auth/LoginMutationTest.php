<?php

namespace Tests\Feature\GraphQL\Mutations\Auth;

use App\Models\User;
use Tests\GraphQLTestCase;

class LoginMutationTest extends GraphQLTestCase
{
    public function testLogInFailed()
    {
        $res = $this->graphqlMutation(
            'login',
            ['email' => 'jo1hn.smith@gmail.com', 'password' => 'default-pass'],
            ['token']
        );
        $res->assertUnAuthorized();
    }

    public function testLogInSuccessfully()
    {
        $user = factory(User::class)->create();
        $res = $this->graphqlMutation(
            'login',
            ['email' => $user->email, 'password' => 'default-pass'],
            ['token']
        );
        $res->assertJsonStructure(['data' => ['login' => ['token']]]);
    }
}
