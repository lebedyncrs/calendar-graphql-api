<?php

namespace Tests\Feature\GraphQL\Mutations\Auth;

use App\Models\Event;
use App\Models\User;
use Tests\GraphQLTestCase;

class UpdateEventMutationTest extends GraphQLTestCase
{
    protected $seedDB = false;

    public function testUnauthorized()
    {
        $res = $this->graphqlMutation('updateEvent', [], ['title']);
        $res->assertUnAuthorized();
    }

    public function testValidationErrors()
    {
        factory(User::class)->create();
        $this->actingAsDefaultUser();

        $res = $this->graphqlMutation('updateEvent', [], ['title']);
        $res->assertJsonValidationErrors(['id']);
    }

    public function testUpdateEvent()
    {
        $user = factory(User::class)->create();
        $event = factory(Event::class)->create(['owner_id' => $user]);
        $this->actingAsDefaultUser();

        $newEventName = 'New Name';
        $res = $this->graphqlMutation(
            'updateEvent',
            ['id' => $event->id, 'title' => $newEventName],
            ['title', 'timezone']
        );

        $res->assertJsonStructure(['data' => ['updateEvent' => ['title']]]);
        $res->assertKeyHasValue('data.updateEvent.title', $newEventName);
    }
}
