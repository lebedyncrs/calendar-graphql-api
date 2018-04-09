<?php

namespace tests\Unit\Models;

use App\Models\User;
use Tests\GraphQLTestCase;

class UserTest extends GraphQLTestCase
{
    public function testGetCreatedAtAttribute()
    {
        $user = factory(User::class)->create([
            'timezone' => 'Africa/Tripoli',
            'created_at' => '2018-04-09 09:40:40',
        ]);
        $this->actingAs($user);

        $this->assertEquals('2018-04-09 11:40:40', $user->created_at);

    }

    public function testGetUpdatedAtAttribute()
    {
        $user = factory(User::class)->create([
            'timezone' => 'Africa/Tripoli',
            'updated_at' => '2018-04-09 09:40:40',
        ]);
        $this->actingAs($user);
        $this->assertEquals('2018-04-09 11:40:40', $user->updated_at);
    }
}