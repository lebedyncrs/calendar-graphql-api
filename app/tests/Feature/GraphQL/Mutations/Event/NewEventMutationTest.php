<?php

namespace Tests\Feature\GraphQL\Mutations\Auth;

use App\Models\User;
use Tests\GraphQLTestCase;

class NewEventMutationTest extends GraphQLTestCase
{
    protected $seedDB = false;

    public function testNewEventUnauthorized()
    {
        $res = $this->graphqlMutation('newEvent', ['title' => 'asd'], ['title']);
        $res->assertUnAuthorized();
    }

    public function testNewEventValidationErrors()
    {
        factory(User::class)->create();
        $this->actingAsDefaultUser();

        $res = $this->graphqlMutation('newEvent', [], ['title']);
        $res->assertJsonValidationErrors(['title', 'timezone']);

        $res = $this->graphqlMutation('newEvent', ['title' => 'StandUp', 'timezone' => 'EUE'], ['title']);
        $res->assertJsonValidationErrors(['timezone']);
    }

    public function testCreateNewEvent()
    {
        factory(User::class)->create();
        $this->actingAsDefaultUser();

        $res = $this->graphqlMutation(
            'newEvent',
            ['title' => 'Stand Up', 'timezone' => 'Africa/Abidjan'],
            ['title', 'timezone']
        );
        $res->assertJsonStructure(['data' => ['newEvent' => ['title', 'timezone']]]);
    }
}
