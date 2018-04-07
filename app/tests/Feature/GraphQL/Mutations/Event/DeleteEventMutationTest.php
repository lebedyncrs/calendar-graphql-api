<?php

namespace Tests\Feature\GraphQL\Mutations\Auth;

use App\Models\Event;
use App\Models\User;
use Tests\GraphQLTestCase;

class DeleteEventMutationTest extends GraphQLTestCase
{
    protected $seedDB = false;

    public function testUnauthorized()
    {
        $res = $this->graphqlMutation('deleteEvent', ['id' => 100], ['deleted']);
        $res->assertUnAuthorized();
    }

    public function testPermissionDenied()
    {
        factory(User::class)->create();
        $user = factory(User::class)->create();
        $this->actingAsDefaultUser();
        $event = factory(Event::class)->create(['owner_id' => $user->id]);

        $res = $this->graphqlMutation('deleteEvent', ['id' => $event->id], ['deleted']);
        $res->assertPermissionDenied();
    }

    public function testValidationErrors()
    {
        factory(User::class)->create();
        $this->actingAsDefaultUser();

        $res = $this->graphqlMutation('deleteEvent', [], ['deleted']);
        $res->assertJsonValidationErrors(['id']);

        $res = $this->graphqlMutation('deleteEvent', ['id' => 132], ['deleted']);
        $res->assertJsonValidationErrors(['id']);
    }

    public function testDeleteEvent()
    {
        $user = factory(User::class)->create();
        $event = factory(Event::class)->create(['owner_id' => $user->id]);
        $this->actingAsDefaultUser();

        $res = $this->graphqlMutation('deleteEvent', ['id' => $event->id], ['deleted']);
        $res->assertJsonStructure(['data' => ['deleteEvent' => ['deleted']]]);
        $res->assertKeyHasValue('data.deleteEvent.deleted', true);
    }
}
