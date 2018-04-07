<?php

namespace Tests\Feature\GraphQL\Mutations\CalendarShare;

use App\Models\AccessLevel;
use App\Models\Calendar;
use App\Models\User;
use Tests\GraphQLTestCase;

class NewCalendarShareMutationTest extends GraphQLTestCase
{
    protected $seedDB = false;

    public function testNewEventUnauthorized()
    {
        $res = $this->graphqlMutation('newCalendarShare', [], ['access_levels_id']);
        $res->assertUnAuthorized();
    }

    public function testNewEventValidationErrors()
    {
        factory(User::class)->create();
        $this->actingAsDefaultUser();

        $res = $this->graphqlMutation('newCalendarShare', [], ['access_levels_id']);
        $res->assertJsonValidationErrors(['users_id', 'access_levels_id']);

        $res = $this->graphqlMutation(
            'newCalendarShare',
            ['users_id' => 11, 'access_levels_id' => 123],
            ['access_levels_id']
        );
        $res->assertJsonValidationErrors(['users_id', 'access_levels_id']);
    }

    public function testCreateNewCalendarShare()
    {
        $loggedInUser = factory(User::class)->create();
        $user = factory(User::class)->create();
        factory(Calendar::class)->create([
            'name' => $loggedInUser->getFullName(), 'owner_id' => $loggedInUser->id
        ]);
        $accessLevel = factory(AccessLevel::class)->create();
        $this->actingAsDefaultUser();

        $res = $this->graphqlMutation(
            'newCalendarShare',
            ['users_id' => $user->id, 'access_levels_id' => $accessLevel->id],
            ['users_id', 'access_levels_id']
        );
        $res->assertJsonStructure(['data' => ['newCalendarShare' => ['users_id', 'access_levels_id']]]);
        $res->assertKeysHaveTypes(
            'data.newCalendarShare',
            ['users_id' => 'int', 'access_levels_id' => 'int']
        );
    }

    public function testUserCanSeeSharedCalendar()
    {
        $this->testCreateNewCalendarShare();
        $this->actingAs(User::find(2));

        $res = $this->graphqlQuery(
            'sharedCalendars',
            [],
            ['data' => ['id', 'name', 'color', 'owner_id', 'created_at', 'updated_at']]
        );
        $res->assertJsonStructure(['data' => ['sharedCalendars' => [
            'data' => [['id', 'name', 'color', 'owner_id', 'created_at', 'updated_at']]
        ]]]);
        $res->assertKeysHaveTypes(
            'data.sharedCalendars.data.0',
            ['id' => 'int', 'name' => 'string', 'color' => 'string', 'owner_id' => 'int', 'created_at' => 'string', 'updated_at' => 'string']
        );
        $res->assertKeyHasValue('data.sharedCalendars.data.0.name', User::find(1)->getFullName());
    }
}
